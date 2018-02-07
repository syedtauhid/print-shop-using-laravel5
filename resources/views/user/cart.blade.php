@extends('user.template.layout')
@section('title')
    Home
@stop
@section('page-specific-css')
@stop
@section('content')
    <section class="">
        <div class="container breadcumb">
            <div class="row">
                <div class="col-sm-3 hidden-xs">
                    <h1 class="mh-title">Shopping Cart</h1>
                </div>
                <div class="breadcrumb-w col-sm-9">
                    <span class="hidden-xs">You are here:</span>
                    <ul class="breadcrumb">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li>
                            <span>Shopping Cart</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="cart-content parten-bg">
        <div class="container">
            <!--Cart top banner -->
            <div class="row">
                <div class="col-md-12 cart-banner-top hidden-xs">
                    <a href="#" title="cart top banner">

                    </a>
                </div>
            </div><!--Cart top banner : End-->
            <!-- Cart title-->
            <div class="row cart-header hidden-xs">
                <div class="col-md-6 col-sm-6 col-xs-12 cart-title">
                    <h1>Shopping cart</h1>
                    <p>If you have any queries, our Customer Services team will be happy to help — just call +44 (0)845 260 3880</p>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 right continue-shopping">
                    <a href="/" title="Continue shopping">
                        Continue Shopping
                        <i class="fa fa-arrow-circle-o-right"></i>
                    </a>
                </div>
            </div><!-- Cart title : End -->
            <div class="row">
                <!--Cart main content : Begin -->
                <section class="cart-main col-md-12 col-xs-12">
                    <!--Cart Item-->
                    <p class="visible-xs mobile-cart-title">There are {{sizeof($cart)}} items in your cart.</p>
                    <div class="table-responsive">
                        <table cellspacing="0" class="table-cart table">
                            <thead class="hidden-xs">
                            <tr>
                                <th class="product-info">Products</th>
                                {{--<th class="product-price">Price</th>--}}
                                <th class="product-quantity">Qty</th>
                                <th class="product-wishlist">Preview</th>
                                <th class="product-subtotal">Price</th>
                                <th class="product-quantity">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($counter = 0)
                            @foreach ($cart as $value)
                            <tr class="cart_item">
                                <td class="product-info">
                                    {{--<div class="product-image-col">--}}
                                        {{--<a class="product-image" title="product card">--}}
                                            {{--<img src="./images/product/cart/product-card.jpg" alt="product card" />--}}
                                        {{--</a>--}}
                                        {{--<div class="product-action">--}}
                                            {{--<a href="#" class="cart-edit" title="Edit Product">--}}
                                                {{--<i class="fa fa-pencil-square-o"></i>--}}
                                            {{--</a>--}}
                                            {{--<a href="#" class="cart-delete" title="Delete Product">--}}
                                                {{--<i class="fa fa-times"></i>--}}
                                            {{--</a>--}}
                                            {{--<a href="#" class="cart-update" title="Update Product">--}}
                                                {{--<i class="fa fa-refresh"></i>--}}
                                            {{--</a>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="product-info-col">
                                        <h3 class="product-name">{{isset($value->PROJECT_NAME) ? $value->PROJECT_NAME : "Demo"}}</h3>
                                        <ul class="pro-option">
                                            @php
                                                $sliceSize = isset($value->press_info_size) ? $value->press_info_size : 4;
                                                $product_info = array_slice((array)$value,-$sliceSize,$sliceSize,true);
                                            @endphp
                                            @foreach ($product_info as $key => $val)
                                            <li>
                                                @php
                                                    if(strtolower($key)=="quantity"){
                                                        $quantity = $val;
                                                    }
                                                @endphp
                                                <span class="pro-opt-label">{{str_replace('_', ' ', $key)}}:</span>
                                                <span class="pro-opt-value">{{$val}}</span>
                                            </li>
                                            @endforeach
                                            <li class="product-price hidden-lg hidden-md hidden-sm">
                                                <span class="pro-opt-label">Price:</span>
                                                <span class="pro-opt-value" style="color: #25bce9;">$ {{$value->total_price}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                {{--<td class="product-price hidden-xs">--}}
                                    {{--<span>$ 24.99</span>--}}
                                {{--</td>--}}
                                <td class="product-quantity hidden-xs">
                                    <input type="number" value="{{$quantity}}"  name="qty" class="qty" id="qty" data-price="24.99" data-pid="1" disabled/>
                                </td>
                                <td class="product-wishlist hidden-xs checkbox-w">
                                    <img src="{{$value->view_image}}" style="max-height: 100px; margin: auto">
                                </td>
                                <td class="product-subtotal hidden-xs">
                                    <span>${{$value->total_price}}</span>
                                </td>
                                <td class="product-quantity hidden-xs">
                                    <a href="{{route('view.cart.remove',$counter)}}" class="remove-item" data-price="{{$value->total_price}}">
                                        <img src="/images/close_red.png" style="height: 30px;width: 30px;margin: auto;">
                                    </a>
                                </td>
                            </tr>
                                @php
                                if (isset($sub_total))
                                   $sub_total += $value->total_price;
                                else
                                   $sub_total = $value->total_price;
                                $counter++;
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row  cart-bottom">
                        <div class="col-sm-4 pull-right subtotal clearfix">

                            <ul>

                                <li class="grand-total">
                                    <span class="sub-title">Grand Total</span>
                                    <span class="sub-value" id="total-price">${{$sub_total}}</span>
                                </li>
                            </ul>

                        </div>
                    </div>
                    <div class="row cart-button">
                        <div class="col-lg-6 col-md-6  col-sm-6 col-xs-6">
                            {{--<button type="button" class=" btn btn-info   btn-update-cart">Update Wishlist</button>--}}
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-6 col-xs-6">
                            <a type="button" class=" btn btn-success btn-checkout pull-right" href="{{route('checkout')}}">Proceed Checkout</a>
                        </div>
                    </div>
                </section><!-- Cart main content : End -->
                <!--Cart right banner: Begin-->
            </div>

        </div>
    </section>
@stop
@section('page-specific-js')
    <script>
        var TOTAL_PRICE = {{$sub_total}};
        $("a.remove-item").click(function (e) {
            e.preventDefault();
            var $item = $(this);
            var url =  $(this).attr('href');
            var price = $item.attr('data-price');
            swal({
                    title: "Want to remove from cart?",
                    text: "",
                    type: "warning",
                    confirmButtonColor: "#DD6B55",
                    showCancelButton: true,
                    confirmButtonText: "Yes, remove it!",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                },
                function(){
                    setTimeout(function(){
                        removeItemFromCart(url,function (data) {
                            console.log("deleted item..." + data);
                            $item.parent().parent().hide();
                            TOTAL_PRICE -= price;
                            if (TOTAL_PRICE <= 0)
                                $('.cart-main').hide();
                            else
                                $("#total-price").html("$" + TOTAL_PRICE);
                            swal({
                                title: "Successful!",
                                text: "Item removed from cart",
                                timer: 1,
                                showConfirmButton: false
                            });
                        });
                    }, 1000);
                });
//            removeItemFromCart(url,function (data) {
//                console.log("deleted item..." + data);
//                $item.parent().parent().hide();
//                TOTAL_PRICE -= price;
//                if (TOTAL_PRICE == 0)
//                    $('.cart-main').hide();
//                $("#total-price").html("$" + TOTAL_PRICE);
//            });
        });
    </script>
@stop