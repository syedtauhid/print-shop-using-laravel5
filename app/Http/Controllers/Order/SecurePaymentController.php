<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/3/2017
 * Time: 8:04 PM
 */

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use League\Flysystem\Exception;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;
use App\Repo\OrderRepo;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class SecurePaymentController extends Controller
{
    /**
     * @var OrderRepo
     */
    private $orderRepo;

    public function __construct(OrderRepo $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function index()
    {
        $ammount = session()->get('payable_total');
        return view('user.secure-payment', compact('ammount'));
    }

    public function getFormPage(){
        $ammount = session()->get('payable_total');
        return view('user.secure-payment-page', compact('ammount'));
    }

    public function chargeCustomerPOST(Request $request){
        $data = $request->all();
        //dd($data);
        $token = $data['stripeToken'];
        $amount = $data['amount'];
        return $this->chargeCustomer($token,$amount);
    }

    public function chargeCustomer($token,$product_price="NA")
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        if (!$this->isStripeCustomer()) {
            $customer = $this->createStripeCustomer($token);
        } else {
            $customer = Customer::retrieve(Auth::user()->stripe_id);
        }
        if (!isset($product_price) || $product_price == "NA"){
            $product_price = floatval(session()->pull('payable_total'));
            $product_price = round($product_price*100);
        }

        return $this->createStripeCharge($product_price, $customer);
    }

    /**
     * Check if the Stripe customer exists.
     *
     * @return boolean
     */
    public function isStripeCustomer()
    {
        return false;
//        try{
//            Auth::user() && \App\User::where('id', Auth::user()->id)->whereNotNull('stripe_id')->first();
//        } catch (Exception $exception){
//            return false;
//        }
//        return true;
    }


    public function createStripeCustomer($token)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $customer = Customer::create(array(
            "email" => Auth::user()->email,
            "source" => $token
        ));

        //Auth::user()->stripe_id = $customer->id;
        Auth::user()->save();

        return $customer;
    }

    public function createStripeCharge($product_price, $customer)
    {
        try {
            $charge = \Stripe\Charge::create(array(
                "amount" => $product_price,
                "customer" => $customer->id,
                'currency' => 'usd'
            ));
        } catch (\Stripe\Error\Card $e) {
            return redirect('/');
        }

        return $this->postStoreOrder();
    }

    public function postStoreOrder()
    {
        session()->pull('cart');
        if (session()->has('current_order_ids')) {
            $orders = json_decode(session()->pull('current_order_ids'));
            foreach ($orders as $id) {
                $this->orderRepo->updateToPaidOrder($id);
            }
        }
        return redirect('user/proof-review');
    }
}