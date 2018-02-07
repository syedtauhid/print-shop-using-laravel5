<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/3/2017
 * Time: 8:04 PM
 */

namespace App\Http\Controllers\Order;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Repo\OrderRepo;
use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    /**
     * @var OrderRepo
     */
    private $orderRepo;

    public function __construct(OrderRepo $orderRepo)
    {

        $this->orderRepo = $orderRepo;
    }

    public function store(Request $request){
        $total = $this->orderRepo->storeOrder($request->all());
        session()->put('payable_total',$total);
        return redirect()->back();
    }
    
    public function userCurrentOrder(){
        $orders = $this->orderRepo->getUserCurrentOrder();
        return view('user.user-order',compact('orders'));
    }

    public function storeUserReview(Request $request){
        $this->orderRepo->storeProductReview($request->all());
        return redirect()->back()->with('success','Your review is stored');
    }

    public function acceptOrder($orderId){
        $this->orderRepo->approveOrder($orderId);
        return redirect()->back();
    }

    public function getUserCompletedOrder(){
        $orders = $this->orderRepo->getUserCompletedOrder();
        return view('user.order-history',compact('orders'));
    }

    public function storeUserReviewImage(Request $request){
        return asset(Helper::storeFile('image/review/',$request->file('file'),$request->get('order_id')));
    }
}