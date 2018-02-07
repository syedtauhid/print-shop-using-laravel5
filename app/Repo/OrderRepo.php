<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/3/2017
 * Time: 7:51 PM
 */

namespace App\Repo;


use App\Model\Order;
use App\Model\OrderLog;
use App\Model\OrderProduct;
use App\Model\OrderReview;
use App\Model\OrderShipInfo;
use App\Model\OrderShippingMethod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderRepo
{
    /**
     * @var Order
     */
    public $order;
    /**
     * @var OrderShipInfo
     */
    private $orderShipInfo;
    /**
     * @var OrderLog
     */
    private $orderLog;
    /**
     * @var OrderProduct
     */
    private $orderProduct;
    /**
     * @var OrderReview
     */
    private $orderReview;
    /**
     * @var OrderShippingMethod
     */
    private $orderShippingMethod;

    public function __construct(Order $order, OrderShipInfo $orderShipInfo, OrderLog $orderLog,
                                OrderProduct $orderProduct, OrderReview $orderReview,
                                OrderShippingMethod $orderShippingMethod)
    {

        $this->order = $order;
        $this->orderShipInfo = $orderShipInfo;
        $this->orderLog = $orderLog;
        $this->orderProduct = $orderProduct;
        $this->orderReview = $orderReview;
        $this->orderShippingMethod = $orderShippingMethod;
    }

    public function storeOrder($input){
        $orderIds = [];
        $cart = json_decode(session()->get('cart'));
        $user = auth()->id();
        unset($input['shipping_cost']);
        $hasDiscount = $input['discount'] == "yes" ? true : false;
        unset($input['discount']);
        $discount = $hasDiscount ? $this->calculateDiscount() : 0;
        $orderMethodId = intval($input['shipment_method']);
        $shippingCost = $orderMethodId == 1 ? 15 : 0;
        unset($input['shipment_method']);
        unset($input['_token']);
        foreach ($cart as $item){
            $price = floatval($item->price);
            $tax = floatval($item->tax);
            $total = $price + $shippingCost + $tax - $discount;
            $job_number = mt_rand(100000, 999999);
            $result = $this->order->create(['user_id' => $user,'status' => "unpaid",'job_number' => $job_number,'price' => $price,'tax' => $tax,
                'shipping_cost' => $shippingCost,'discount' => $discount,'total' => $total,'order_shipping_method_id' => $orderMethodId]);
            $orderId = $result->id;
            $result = $this->storeProduct($item,$price,$orderId);
            $this->storeOrderLog($orderId,"unpaid",$result->id);
            $input['order_id'] = $orderId;
            $this->storeShipmentInfo($input);
            array_push($orderIds,$orderId);
            if (isset($netTotal))
                $netTotal += $total;
            else
                $netTotal = $total;
        }
        session()->put('current_order_ids',json_encode($orderIds));
        return $netTotal;
    }

    public function calculateDiscount(){
        return 0;
    }

    public function storeProduct($product,$price,$orderId){
        $quantity = $product->Quantity;
        unset($product->Quantity);
        $name = $product->PROJECT_NAME;
        unset($product->PROJECT_NAME);
        $categoryId = $product->category_id;
        unset($product->category_id);
        unset($product->view_image);
        $templateId = !empty($product->template_id)?$product->template_id:null;
        $productJson = json_encode($product);

        $result = $this->orderProduct->create(['order_id' => $orderId,'name' => $name,'category_id' => $categoryId,'price' => $price,
            'product_info' => $productJson,'quantity' => $quantity,'template_id'=>$templateId]);
        return $result;
    }

    public function storeShipmentInfo($input){
        $this->orderShipInfo->create($input);
    }

    public function getUserCurrentOrder(){
        $data = $this->order
                    ->with('orderProduct','orderShipInfo','orderShippingMethod','orderProduct.orderReview',
                        'orderProduct.category','orderProduct.category.parent',
                        'orderProduct.category.parent.categoryUpload','orderLogs','orderProduct.category.categoryUpload')
                    ->where('user_id',Auth::id())
                    ->where('status','!=','completed')
                    ->get();
        return $data;
    }


    public function getUserCompletedOrder(){
        $data = $this->order
            ->with('orderProduct','orderShipInfo','orderShippingMethod','orderProduct.orderReview','orderLogs')
            ->where('user_id',Auth::id())
            ->where('status','=','completed')
            ->get();
        return $data;
    }

    public function getOrdersByStatus($caller,$status){
        $data = $this->order
            ->select('orders.*','order_products.name','order_products.template_id','categories.name as catName',
                'order_shipping_method.method as shipMethod')
            ->join('order_products','order_products.order_id','=','orders.id')
            ->join('categories','categories.id','=','order_products.category_id')
            ->leftJoin('order_shipping_method','order_shipping_method.id','=','orders.order_shipping_method_id')
            ->where('status','=',$status)->get();

        return $data;
    }

    public function getOrderDetails($orderId){
        $data = $this->order
            ->with(['orderProduct','orderShipInfo','orderShippingMethod','orderProduct.orderReview',
                'user','user.userInfo','orderProduct.category','orderProduct.category.parent',
                'orderProduct.category.parent.categoryUpload','orderLogs'])
            ->where('id',$orderId)
            ->first();
        return $data;
    }

    public function getProductDetails($productId){
        $data = $this->orderProduct->with('orderReview')->where('id',$productId)->get();
        return $data;
    }

    public function updateToPaidOrder($orderId){
        $this->changeOrderStatus($orderId,'new');
        $this->changeOrderLogStatus($orderId,'new');
    }

    public function approveOrder($orderId){
        $this->changeOrderStatus($orderId,'approved');
        $this->storeOrderLog($orderId,'approved');
    }

    public function deliverOrder($orderId){
        $order = $this->order->find($orderId);
        if($order->order_shipping_method_id){
            if($order->order_shipping_method_id==1){
                //@todo: ship order with fedex

                $this->changeOrderStatus($orderId,'ship');
                $this->storeOrderLog($orderId,'ship');
            }else{
                $this->changeOrderStatus($orderId,'pick');
                $this->storeOrderLog($orderId,'pick');
            }
        }else{
            
        }
    }

    public function markOrderAsComplete($orderId){
        $this->changeOrderStatus($orderId,'complete');
        $this->storeOrderLog($orderId,'complete');
    }

    public function uploadDesignFromAdminForCustomerReview($productId,$uploadedDesign,$status){
        $orderProduct = $this->orderProduct->find($productId);
        $adminUploadedData = $orderProduct->admin_upload?json_decode($orderProduct->admin_upload):[];
        array_push($adminUploadedData,$uploadedDesign);
        $orderProduct->admin_upload = json_encode($adminUploadedData);
        $orderProduct->save();
        $this->changeOrderStatus($orderProduct->order_id,'prog-upload');
        $this->storeOrderLog($orderProduct->order_id,'prog-upload');

        //@todo: mail user for order review
    }

    public function storeProductReview($data){
        $this->orderReview->create($data);

        $this->changeOrderStatus($data['order_id'],'prog-review');
        $this->storeOrderLog($data['order_id'],'prog-review',$data['order_product_id']);

    }

    public function changeOrderStatus($orderId,$status){
        $order = $this->order->find($orderId);
        $order->status = $status;
        $order->save();
    }

    public function changeOrderLogStatus($orderId,$status){
        $order = $this->orderLog->find($orderId);
        $order->status = $status;
        $order->save();
    }

    public function storeOrderLog($orderId,$status,$productId=null){
        $this->orderLog->order_id = $orderId;
        $this->orderLog->user_id = Auth::id();
        $this->orderLog->order_product_id = $productId;
        $this->orderLog->status = $status;
        $this->orderLog->save();
    }

    public function countOrderByStatus(){
        $data = $this->order->select('status',DB::raw('count(id) as count'))->groupBy('status')->pluck('count','status');
        return $data;
    }

}
