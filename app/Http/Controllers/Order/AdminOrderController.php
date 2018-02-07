<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/3/2017
 * Time: 10:51 PM
 */

namespace App\Http\Controllers\Order;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Repo\OrderRepo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    /**
     * @var OrderRepo
     */
    private $orderRepo;

    public function __construct(OrderRepo $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }



    public function getOrderByStatus($status){
        $data = $this->orderRepo->getOrdersByStatus('admin',$status);
//	dd($data);
        return view('admin.order.'.$status.'-order',compact('data'));
    }

    public function getOrderDetails($orderId){
        $data = $this->orderRepo->getOrderDetails($orderId);
        return view('admin.order.order-details',compact('data'));
    }

    public function changeOrderStatusFromNewToProgressUpload($orderId,$orderProductId,Request $request){
        $uploadedImage = $request->allFiles();
        $uploadedDataToStore = [];
        
        foreach ($uploadedImage as $key=>$item){
            $uploadedDataToStore[$key] = Helper::storeFile('/image/uploaded/',$item,$orderId.'_'.$orderProductId.'_'.$key);
        }
        $uploadedDataToStore['created_at']=Carbon::now()->toDateTimeString();
        $this->orderRepo->uploadDesignFromAdminForCustomerReview($orderProductId,$uploadedDataToStore,'new');

        return redirect()->back()->with('success','Image uploaded for customer review');
    }

    public function changeOrderStatusFromProgressReviewToProgressUpload($orderId,$orderProductId,Request $request){
        $uploadedImage = $request->allFiles();
        $uploadedDataToStore = [];

        foreach ($uploadedImage as $key=>$item){
            $uploadedDataToStore[$key] = Helper::storeFile('/image/uploaded/',$item,$orderId.'_'.$orderProductId.'_'.$key);
        }
        $uploadedDataToStore['created_at']=Carbon::now()->toDateTimeString();
        $this->orderRepo->uploadDesignFromAdminForCustomerReview($orderProductId,$uploadedDataToStore,'prog-review');

        return redirect()->back()->with('success','Image uploaded for customer review');
    }

    public function changeOrderStatusFromApprovedToProduction($orderId){
        $order = $this->orderRepo->order->find($orderId);
        if($order->status=="approved"){
            $this->orderRepo->changeOrderStatus($orderId,'production');
            $this->orderRepo->storeOrderLog($orderId,'production');
            return redirect()->back()->with('success','Order is now in production');
        }
        return redirect()->back()->withErrors(['Order is not approved by customer yet']);
    }

    public function changeOrderStatusFromProductionToPickOrShip($orderId,$status){
        $order = $this->orderRepo->order->find($orderId);
        if($order->status=="production"){
            $this->orderRepo->changeOrderStatus($orderId,$status);
            $this->orderRepo->storeOrderLog($orderId,$status);
            return redirect()->back()->with('success','Order is now in '.$status);
        }
        return redirect()->back()->withErrors(['Order is not ready for '.$status.' yet']);
    }

    public function changeOrderStatusFromPickOrShipToComplete($orderId){
        $order = $this->orderRepo->order->find($orderId);
        if($order->status=="pick" || $order->status=="ship"){
            $this->orderRepo->changeOrderStatus($orderId,'completed');
            $this->orderRepo->storeOrderLog($orderId,'completed');
            return redirect()->back()->with('success','Order is now completed');
        }
        return redirect()->back()->withErrors(['Order is not ready for complete yet']);
    }
}
