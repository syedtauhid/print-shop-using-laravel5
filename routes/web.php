<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::get('referal_code',['as'=>'referal_code','uses'=>'Member\UserReferalController@sendReferalCode']);

Auth::routes();
Route::get('register',['middleware' => ['guest','referal.key.checker'],'as'=>'register','uses'=>'Auth\RegisterController@showRegistrationForm']);
Route::get('logout',['as'=>'logout','uses'=>'Auth\LoginController@logout']);

Route::get('category',function (){
    return view('user.sub-category.category');
});
Route::get('category1',function (){
    return view('user.category');
});
Route::get('cart',function (){
   return view('user.cart');
});
Route::get('checkout',function (){
    return view('user.checkout');
});
//contact us and about us
Route::get('contact',function (){
    return view('user.contact-us');
});
Route::get('about',function (){
    return view('user.about-us');
});

Route::group(['middleware' => ['auth','admin'],'prefix' => 'admin'], function () {

    Route::get('/',['as'=>'admin.dashboard','uses'=>'Admin\DashboardController@index']);

    Route::resource('category','Admin\AdminCategoryController',['as'=>'admin']);
    Route::post('category/{id}',['as'=>'admin.category.destroy','uses'=>'Admin\AdminCategoryController@destroy']);

    Route::get('upload-info/delete/{id}',['as'=>'admin.category.upload-info.delete','uses'=>'Admin\AdminCategoryController@deleteUploadInfo']);
    Route::post('category/{id}/upload-info',['as'=>'admin.category.upload-info','uses'=>'Admin\AdminCategoryController@postUploadInfo']);
    Route::post('category/{categoryId}/upload-info/{uploadInfoId}/update',['as'=>'admin.category.upload-info.update','uses'=>'Admin\AdminCategoryController@updateUploadInfo']);
    Route::get('category/{id}/upload-info',['as'=>'admin.category.upload-info','uses'=>'Admin\AdminCategoryController@getUploadInfo']);
    Route::get('category/{id}/upload-info-json',['as'=>'admin.category.upload-info.json','uses'=>'Admin\AdminCategoryController@getUploadInfoJson']);

    Route::get('print-info/delete/{id}',['as'=>'admin.category.print-info.delete','uses'=>'Admin\AdminCategoryController@deletePrintInfo']);
    Route::post('category/{id}/print-info',['as'=>'admin.category.print-info','uses'=>'Admin\AdminCategoryController@postPrintInfo']);
    Route::post('category/{id}/print-info/{printInfoId}/update',['as'=>'admin.category.print-info.update','uses'=>'Admin\AdminCategoryController@updatePrintInfo']);
    Route::get('category/{id}/print-info',['as'=>'admin.category.print-info','uses'=>'Admin\AdminCategoryController@getPrintInfo']);

    Route::get('press-info/delete/{id}',['as'=>'admin.category.press-info.delete','uses'=>'Admin\AdminCategoryController@deletePressInfo']);
    Route::post('category/{id}/press-info',['as'=>'admin.category.press-info','uses'=>'Admin\AdminCategoryController@postPressInfo']);
    Route::post('category/{id}/press-info/{pressInfoId}/update',['as'=>'admin.category.press-info.update','uses'=>'Admin\AdminCategoryController@updatePressInfo']);
    Route::get('category/{id}/press-info',['as'=>'admin.category.press-info','uses'=>'Admin\AdminCategoryController@getPressInfo']);

    Route::get('category/{id}/price-map',['as'=>'admin.category.price-map','uses'=>'Admin\AdminCategoryController@getPriceMap']);
    Route::post('category/{id}/price-map',['as'=>'admin.category.price-map.store','uses'=>'Admin\AdminCategoryController@storePriceMap']);
    Route::post('category/{id}/price-map-dependency',['as'=>'admin.category.price-map-dependency','uses'=>'Admin\AdminCategoryController@postPriceMapDependency']);
    Route::get('price-map/{id}/delete',['as'=>'admin.category.price-map.delete','uses'=>'Admin\AdminCategoryController@deletePriceMap']);


    Route::get('special/category',['as'=>'admin.special.category.index','uses'=>'Admin\AdminCategoryController@getSpecialCategories']);
    Route::get('special/category/create',['as'=>'admin.special.category.create','uses'=>'Admin\AdminCategoryController@createSpecialCategories']);
    Route::post('special/category/store',['as'=>'admin.special.category.store','uses'=>'Admin\AdminCategoryController@storeSpecialCategories']);
    Route::get('special/category/delete/{id}',['as'=>'admin.special.category.delete','uses'=>'Admin\AdminCategoryController@deleteSpecialCategories']);
    Route::get('special/category/status/{id}',['as'=>'admin.special.category.status','uses'=>'Admin\AdminCategoryController@toggleSpecialCategoryStatus']);

    Route::resource('template','Admin\AdminTemplateController',['as'=>'admin']);
    Route::get('template/{id}/destroy',['as'=>'admin.template.destroy','uses'=>'Admin\AdminTemplateController@destroy']);

    Route::get('order/{status}',['as'=>'admin.order.status','uses'=>'Order\AdminOrderController@getOrderByStatus']);
    Route::get('order/detail/{id}',['as'=>'admin.order.detail','uses'=>'Order\AdminOrderController@getOrderDetails']);
    Route::post('order/{orderId}/new/product/{productId}',['as'=>'admin.order.post.new','uses'=>'Order\AdminOrderController@changeOrderStatusFromNewToProgressUpload']);
    Route::post('order/{orderId}/prog-review/product/{productId}',['as'=>'admin.order.post.prog-review','uses'=>'Order\AdminOrderController@changeOrderStatusFromProgressReviewToProgressUpload']);
    Route::get('order/{orderId}/status/complete',['as'=>'admin.order.to.complete','uses'=>'Order\AdminOrderController@changeOrderStatusFromPickOrShipToComplete']);
    Route::get('order/{orderId}/status/production',['as'=>'admin.order.to.production','uses'=>'Order\AdminOrderController@changeOrderStatusFromApprovedToProduction']);
    Route::get('order/{orderId}/status/{shippingMethod}',['as'=>'admin.order.to.pick-ship','uses'=>'Order\AdminOrderController@changeOrderStatusFromProductionToPickOrShip']);

    Route::get('tax-exempt',['as'=>'admin.tax-exempt','uses'=>'Admin\AdminTaxExemptController@getFormUpload']);
    Route::post('tax-exempt',['as'=>'admin.tax-exempt.store','uses'=>'Admin\AdminTaxExemptController@postFormUpload']);
    Route::get('tax-exempt/pending',['as'=>'admin.tax-exempt.pending','uses'=>'Admin\AdminTaxExemptController@pendingForms']);
    Route::get('tax-exempt/accepted',['as'=>'admin.tax-exempt.accepted','uses'=>'Admin\AdminTaxExemptController@acceptedForms']);
    Route::get('tax-exempt/{id}/{status}',['as'=>'admin.tax-exempt.change.status','uses'=>'Admin\AdminTaxExemptController@changeStatus']);
});

Route::group(['middleware' => 'auth'],function (){
    Route::group(['prefix'=>'user'],function (){
        Route::get('info',['as'=>'user.info','uses'=>'Member\UserInfoController@index']);
        Route::post('info',['as'=>'user.info','uses'=>'Member\UserInfoController@updateUserInfo']);
        Route::get('proof-review',['as'=>'user.proof-review','uses'=>'Order\UserOrderController@userCurrentOrder']);
        Route::post('review/store/image',['as'=>'user.review.store.image','uses'=>'Order\UserOrderController@storeUserReviewImage']);
        Route::post('review/store',['as'=>'user.store.review','uses'=>'Order\UserOrderController@storeUserReview']);
        Route::get('address',['as'=>'user.address','uses'=>function (){
            return view('user.user-address');
        }]);
        Route::get('tax-exempt',['as'=>'user.tax-exempt','uses'=>'Member\TaxExemptController@index']);
        Route::post('tax-exempt',['as'=>'user.tax-exempt.store','uses'=>'Member\TaxExemptController@store']);
        Route::get('order-history',['as'=>'uesr.order-history','uses'=>'Order\UserOrderController@getUserCompletedOrder']);
        Route::get('card-information',['as'=>'user.card-information','uses'=>'Member\UserCardController@index']);
        Route::post('card-information',['as'=>'user.card-information','uses'=>'Member\UserCardController@store']);
        Route::post('card-information/update/{id}',['as'=>'user.card-information.update','uses'=>'Member\UserCardController@update']);
        Route::post('card-information/delete',['as'=>'user.card-information.delete','uses'=>'Member\UserCardController@delete']);
        Route::get('refer',['as'=>'user.refer','uses'=>function (){
            return view('user.user-referd');
        }]);

        Route::post('user-refer',['as'=>'user.user-referd','uses'=>'Member\UserReferalController@sendReferalCode']);
    });
    Route::get('checkout',['as'=>'checkout','uses'=>'Member\CheckoutController@index']);
    Route::post('order/store',['as'=>'order.store','uses'=>'Order\UserOrderController@store']);
    Route::get('order/accepted/{orderId}',['as'=>'order.user.accepted','uses'=>'Order\UserOrderController@acceptOrder']);
    Route::get('secure/payment/',['as'=>'secure.payment','uses'=>'Order\SecurePaymentController@index']);
    Route::get('secure/payment/page/',['as'=>'secure.payment.page','uses'=>'Order\SecurePaymentController@getFormPage']);
    Route::get('secure/payment/{token}/charge',['as'=>'secure.payment.charge','uses'=>'Order\SecurePaymentController@chargeCustomer']);
    Route::post('secure/payment/charge',['as'=>'secure.payment.post.charge','uses'=>'Order\SecurePaymentController@chargeCustomerPOST']);
});

Route::resource('home','HomeController');
Route::get('category/{id}',['as'=>'subcategory','uses'=>'Member\UserCategoryController@getSubCategoryView']);
Route::get('category/details/{id}',['as'=>'category.details','uses'=>'Member\UserCategoryController@getCategoryDetailsById']);
Route::get('category/{id}/template',['as'=>'category.template','uses'=>'Member\UserTemplateController@index']);
Route::post('category/{id}/template/upload/store',['as'=>'template.user.upload','uses'=>'Member\UserTemplateController@storeUserTemplateInfo']);
Route::get('category/{id}/template/{templateId}',['as'=>'template.selected','uses'=>'Member\UserTemplateController@storeSelectedTemplateId']);
Route::get('print-info',['as'=>'print.info','uses'=>'Member\PrintInfoController@index']);

Route::post('print-info/post',['as'=>'print.info.post','uses'=>'Member\PrintInfoController@store']);
Route::get('press-info',['as'=>'press.info','uses'=>'Member\PressInfoController@index']);
Route::post('press-info/post',['as'=>'press.info.post','uses'=>'Member\PressInfoController@storeAndCheckout']);
Route::post('press-info/add-to-cart',['as'=>'press.info.cart','uses'=>'Member\PressInfoController@store']);
Route::get('view-cart',['as'=>'view.cart','uses'=>'Member\CartController@index']);
Route::post('view-cart',['as'=>'view.cart','uses'=>'Member\CartController@index']);
Route::get('view-cart/remove-from-cart/{id}',['as'=>'view.cart.remove','uses'=>'Member\CartController@deleteItemFromCart']);


Route::get('test-mail',function (){
    \Illuminate\Support\Facades\Mail::to('shovoshopno@gmail.com')->send(new \App\Mail\Test());
    dd('sent');
});
Route::get('test-lang',function (){
    dd(\Illuminate\Support\Facades\Auth::id());
   dd(trans('orderStatus.prog-upload'));
});

Route::get('test-auth',function () {
    dd(Auth::user()->email);
});

Route::get('create-test-user',function (){
   \App\User::create([
       'email'=>'admin@dgd.com',
       'password'=>bcrypt('10791079'),
       'name'=>'admin'
   ]);
});

Route::any( '(.*)', ['as'=>'404','uses'=>function( $page ){
    return view('errors.404');
}]);
