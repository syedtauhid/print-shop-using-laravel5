<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Repo\CategoryRepo;
use App\Repo\TemplateRepo;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * @var CategoryRepo
     */
    private $categoryRepo;
    /**
     * @var TemplateRepo
     */
    private $templateRepo;

    public function __construct(CategoryRepo $categoryRepo, TemplateRepo $templateRepo)
    {
        $this->categoryRepo = $categoryRepo;
        $this->templateRepo = $templateRepo;
    }

    public function index(){
        $cart = json_decode(session()->get('cart'));
        //$categoryDetails = $this->categoryRepo->getCategoryDetailsById($cart->category_id);
        //dd($print);
        //dd($cart);
        if (sizeof($cart) > 0)
            return view('user.cart',compact('cart'));
        else
            return redirect('/');
    }

    public function deleteItemFromCart($id) {
        $cart = json_decode(session()->pull('cart'));
        if ($id < sizeof($cart)){
            unset($cart[$id]);
        }
        if (sizeof($cart) > 0)
            session()->put('cart',json_encode($cart));
    }

//    public function store(Request $request){
//        $currentCartSession = [];
//        $files = $request->allFiles();
//        foreach ($files as $key=>$item){
//            $itemName = $this->storeImage($item);
//            $userTemplateInfo[$key] = $itemName;
//        }
//        if (isset($userTemplateInfo)) {
//            $data = $request->except(array_keys($userTemplateInfo));
//            $data = array_merge($userTemplateInfo,$data);
//        } else {
//            $data = $request->all();
//        }
//        unset($data['_token']);
//        // Add/update Session
//        if (session()->has('cart')){
//            $currentCartSession = json_decode(session()->pull('cart'));
//        }
//        array_push($currentCartSession,$data);
//        session()->put('cart',json_encode($currentCartSession));
//    }
//
//    public function storeAndCheckout(Request $request){
//        $this->store($request);
//        return redirect()->route('checkout');
//    }

    private function storeImage($image){
        $rand = Carbon::now()->timestamp;
        $path = '/image/template/user/';
        $imageName = $image->getClientOriginalName().'_'.$rand.'.'.$image->getClientOriginalExtension();
        $image->move(public_path($path),$imageName);
        return $path.$imageName;
    }

}
