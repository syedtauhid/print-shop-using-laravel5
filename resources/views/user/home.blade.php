@extends('user.template.layout')
@section('title')
    Home
@stop
@section('page-specific-css')
    <style>
        .pro-item{
            padding:15px !important;
        }
        .product-info{
            font-size: 18px;
            color: #444444;
            font-weight: 600;
            width: 100%;
        }
    </style>
@stop
@section('content')

        <!--Home slider : Begin-->
        <section class="home-slidershow">
            <div class="container">
                <div class="row">
                    <div class="slide-show">
                        <div class="vt-slideshow">
                            <ul>
                                <li class="slide1" data-transition="random"><img src="./images/slider/home/bg_slider_1.jpg" alt="" />
                                </li>
                                <li class="slide2" data-transition="random"><img src="./images/slider/home/bg_slider_2.jpg" alt="" />
                                </li>
                                <li class="slide3" data-transition="random"><img src="./images/slider/home/bg_slider_3.jpg" alt="" />
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>

        </section>
        <!--Home Promotions Products : Begin -->
        <section class="home-promotion-product home-product ">
            <div class="container parten-bg">
                <div class="row">
                    <div class="block-title-w">
                        <h2 class="block-title">Promotions Products</h2>
						<span class="icon-title">
							<span></span>
							<i class="fa fa-star"></i>
						</span>
                    </div>
                    {{--<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">--}}
                        {{--<div class="col-md-3 col-lg-3 col-sm-4 col-xs-6">--}}
                            {{--<div class="product-image-action pro-item">--}}
                                {{--<img src="./images/product/263x263/1.jpg" alt="Grouper Business card" />--}}
                                {{--<div class="action">--}}
                                    {{--<button type="button" data-toggle="tooltip" data-placement="top" class="add-to-cart gbtn" title="Add to cart">--}}
                                        {{--<i class="fa fa-shopping-cart"></i>--}}
                                    {{--</button>--}}
                                    {{--<a href="#" data-toggle="tooltip" data-placement="top" title="Wishlist" class="add-to-wishlist">--}}
                                        {{--<i class="fa fa-heart"></i>--}}
                                    {{--</a>--}}
                                    {{--<a href="#" data-toggle="tooltip" data-placement="top" title="compare" class="add-to-compare">--}}
                                        {{--<i class="fa fa-refresh"></i>--}}
                                    {{--</a>--}}
                                    {{--<a href="#" data-toggle="tooltip" data-placement="top" title="Quickview" class="quick-view">--}}
                                        {{--<i class="fa fa-eye"></i>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                                {{--<span class="product-icon sale-icon">sale!</span>--}}
                            {{--</div>--}}
                            {{--<div class="product-info">--}}
                                {{--<a href="./detail.html" title="product" class="product-name">Grouper Business card</a>--}}
                                {{--<div class="price-box">--}}
                                    {{--<span class="normal-price">$ 9.00</span>--}}
                                {{--</div>--}}
                                {{--<div class="rating-box">--}}
                                    {{--<i class="fa fa-star"></i>--}}
                                    {{--<i class="fa fa-star"></i>--}}
                                    {{--<i class="fa fa-star-half-o"></i>--}}
                                    {{--<i class="fa fa-star-o"></i>--}}
                                    {{--<i class="fa fa-star-o"></i>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-3 col-lg-3 col-sm-4 col-xs-6">--}}
                            {{--<div class="product-image-action pro-item">--}}
                                {{--<img src="./images/product/263x263/1.jpg" alt="Grouper Business card" />--}}
                                {{--<div class="action">--}}
                                    {{--<button type="button" data-toggle="tooltip" data-placement="top" class="add-to-cart gbtn" title="Add to cart">--}}
                                        {{--<i class="fa fa-shopping-cart"></i>--}}
                                    {{--</button>--}}
                                    {{--<a href="#" data-toggle="tooltip" data-placement="top" title="Wishlist" class="add-to-wishlist">--}}
                                        {{--<i class="fa fa-heart"></i>--}}
                                    {{--</a>--}}
                                    {{--<a href="#" data-toggle="tooltip" data-placement="top" title="compare" class="add-to-compare">--}}
                                        {{--<i class="fa fa-refresh"></i>--}}
                                    {{--</a>--}}
                                    {{--<a href="#" data-toggle="tooltip" data-placement="top" title="Quickview" class="quick-view">--}}
                                        {{--<i class="fa fa-eye"></i>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                                {{--<span class="product-icon sale-icon">sale!</span>--}}
                            {{--</div>--}}
                            {{--<div class="product-info">--}}
                                {{--<a href="./detail.html" title="product" class="product-name">Grouper Business card</a>--}}
                                {{--<div class="price-box">--}}
                                    {{--<span class="normal-price">$ 9.00</span>--}}
                                {{--</div>--}}
                                {{--<div class="rating-box">--}}
                                    {{--<i class="fa fa-star"></i>--}}
                                    {{--<i class="fa fa-star"></i>--}}
                                    {{--<i class="fa fa-star-half-o"></i>--}}
                                    {{--<i class="fa fa-star-o"></i>--}}
                                    {{--<i class="fa fa-star-o"></i>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-3 col-lg-3 col-sm-4 col-xs-6">--}}
                            {{--<div class="product-image-action pro-item">--}}
                                {{--<img src="./images/product/263x263/1.jpg" alt="Grouper Business card" />--}}
                                {{--<div class="action">--}}
                                    {{--<button type="button" data-toggle="tooltip" data-placement="top" class="add-to-cart gbtn" title="Add to cart">--}}
                                        {{--<i class="fa fa-shopping-cart"></i>--}}
                                    {{--</button>--}}
                                    {{--<a href="#" data-toggle="tooltip" data-placement="top" title="Wishlist" class="add-to-wishlist">--}}
                                        {{--<i class="fa fa-heart"></i>--}}
                                    {{--</a>--}}
                                    {{--<a href="#" data-toggle="tooltip" data-placement="top" title="compare" class="add-to-compare">--}}
                                        {{--<i class="fa fa-refresh"></i>--}}
                                    {{--</a>--}}
                                    {{--<a href="#" data-toggle="tooltip" data-placement="top" title="Quickview" class="quick-view">--}}
                                        {{--<i class="fa fa-eye"></i>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                                {{--<span class="product-icon sale-icon">sale!</span>--}}
                            {{--</div>--}}
                            {{--<div class="product-info">--}}
                                {{--<a href="./detail.html" title="product" class="product-name">Grouper Business card</a>--}}
                                {{--<div class="price-box">--}}
                                    {{--<span class="normal-price">$ 9.00</span>--}}
                                {{--</div>--}}
                                {{--<div class="rating-box">--}}
                                    {{--<i class="fa fa-star"></i>--}}
                                    {{--<i class="fa fa-star"></i>--}}
                                    {{--<i class="fa fa-star-half-o"></i>--}}
                                    {{--<i class="fa fa-star-o"></i>--}}
                                    {{--<i class="fa fa-star-o"></i>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-3 col-lg-3 col-sm-4 col-xs-6">--}}
                            {{--<div class="product-image-action pro-item">--}}
                                {{--<img src="./images/product/263x263/1.jpg" alt="Grouper Business card" />--}}
                                {{--<div class="action">--}}
                                    {{--<button type="button" data-toggle="tooltip" data-placement="top" class="add-to-cart gbtn" title="Add to cart">--}}
                                        {{--<i class="fa fa-shopping-cart"></i>--}}
                                    {{--</button>--}}
                                    {{--<a href="#" data-toggle="tooltip" data-placement="top" title="Wishlist" class="add-to-wishlist">--}}
                                        {{--<i class="fa fa-heart"></i>--}}
                                    {{--</a>--}}
                                    {{--<a href="#" data-toggle="tooltip" data-placement="top" title="compare" class="add-to-compare">--}}
                                        {{--<i class="fa fa-refresh"></i>--}}
                                    {{--</a>--}}
                                    {{--<a href="#" data-toggle="tooltip" data-placement="top" title="Quickview" class="quick-view">--}}
                                        {{--<i class="fa fa-eye"></i>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                                {{--<span class="product-icon sale-icon">sale!</span>--}}
                            {{--</div>--}}
                            {{--<div class="product-info">--}}
                                {{--<a href="./detail.html" title="product" class="product-name">Grouper Business card</a>--}}
                                {{--<div class="price-box">--}}
                                    {{--<span class="normal-price">$ 9.00</span>--}}
                                {{--</div>--}}
                                {{--<div class="rating-box">--}}
                                    {{--<i class="fa fa-star"></i>--}}
                                    {{--<i class="fa fa-star"></i>--}}
                                    {{--<i class="fa fa-star-half-o"></i>--}}
                                    {{--<i class="fa fa-star-o"></i>--}}
                                    {{--<i class="fa fa-star-o"></i>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-3 col-lg-3 col-sm-4 col-xs-6">--}}
                            {{--<div class="product-image-action pro-item">--}}
                                {{--<img src="./images/product/263x263/1.jpg" alt="Grouper Business card" />--}}
                                {{--<div class="action">--}}
                                    {{--<button type="button" data-toggle="tooltip" data-placement="top" class="add-to-cart gbtn" title="Add to cart">--}}
                                        {{--<i class="fa fa-shopping-cart"></i>--}}
                                    {{--</button>--}}
                                    {{--<a href="#" data-toggle="tooltip" data-placement="top" title="Wishlist" class="add-to-wishlist">--}}
                                        {{--<i class="fa fa-heart"></i>--}}
                                    {{--</a>--}}
                                    {{--<a href="#" data-toggle="tooltip" data-placement="top" title="compare" class="add-to-compare">--}}
                                        {{--<i class="fa fa-refresh"></i>--}}
                                    {{--</a>--}}
                                    {{--<a href="#" data-toggle="tooltip" data-placement="top" title="Quickview" class="quick-view">--}}
                                        {{--<i class="fa fa-eye"></i>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                                {{--<span class="product-icon sale-icon">sale!</span>--}}
                            {{--</div>--}}
                            {{--<div class="product-info">--}}
                                {{--<a href="./detail.html" title="product" class="product-name">Grouper Business card</a>--}}
                                {{--<div class="price-box">--}}
                                    {{--<span class="normal-price">$ 9.00</span>--}}
                                {{--</div>--}}
                                {{--<div class="rating-box">--}}
                                    {{--<i class="fa fa-star"></i>--}}
                                    {{--<i class="fa fa-star"></i>--}}
                                    {{--<i class="fa fa-star-half-o"></i>--}}
                                    {{--<i class="fa fa-star-o"></i>--}}
                                    {{--<i class="fa fa-star-o"></i>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-3 col-lg-3 col-sm-4 col-xs-6">--}}
                            {{--<div class="product-image-action pro-item">--}}
                                {{--<img src="./images/product/263x263/1.jpg" alt="Grouper Business card" />--}}
                                {{--<div class="action">--}}
                                    {{--<button type="button" data-toggle="tooltip" data-placement="top" class="add-to-cart gbtn" title="Add to cart">--}}
                                        {{--<i class="fa fa-shopping-cart"></i>--}}
                                    {{--</button>--}}
                                    {{--<a href="#" data-toggle="tooltip" data-placement="top" title="Wishlist" class="add-to-wishlist">--}}
                                        {{--<i class="fa fa-heart"></i>--}}
                                    {{--</a>--}}
                                    {{--<a href="#" data-toggle="tooltip" data-placement="top" title="compare" class="add-to-compare">--}}
                                        {{--<i class="fa fa-refresh"></i>--}}
                                    {{--</a>--}}
                                    {{--<a href="#" data-toggle="tooltip" data-placement="top" title="Quickview" class="quick-view">--}}
                                        {{--<i class="fa fa-eye"></i>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                                {{--<span class="product-icon sale-icon">sale!</span>--}}
                            {{--</div>--}}
                            {{--<div class="product-info">--}}
                                {{--<a href="./detail.html" title="product" class="product-name">Grouper Business card</a>--}}
                                {{--<div class="price-box">--}}
                                    {{--<span class="normal-price">$ 9.00</span>--}}
                                {{--</div>--}}
                                {{--<div class="rating-box">--}}
                                    {{--<i class="fa fa-star"></i>--}}
                                    {{--<i class="fa fa-star"></i>--}}
                                    {{--<i class="fa fa-star-half-o"></i>--}}
                                    {{--<i class="fa fa-star-o"></i>--}}
                                    {{--<i class="fa fa-star-o"></i>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-3 col-lg-3 col-sm-4 col-xs-6">--}}
                            {{--<div class="product-image-action pro-item">--}}
                                {{--<img src="./images/product/263x263/1.jpg" alt="Grouper Business card" />--}}
                                {{--<div class="action">--}}
                                    {{--<button type="button" data-toggle="tooltip" data-placement="top" class="add-to-cart gbtn" title="Add to cart">--}}
                                        {{--<i class="fa fa-shopping-cart"></i>--}}
                                    {{--</button>--}}
                                    {{--<a href="#" data-toggle="tooltip" data-placement="top" title="Wishlist" class="add-to-wishlist">--}}
                                        {{--<i class="fa fa-heart"></i>--}}
                                    {{--</a>--}}
                                    {{--<a href="#" data-toggle="tooltip" data-placement="top" title="compare" class="add-to-compare">--}}
                                        {{--<i class="fa fa-refresh"></i>--}}
                                    {{--</a>--}}
                                    {{--<a href="#" data-toggle="tooltip" data-placement="top" title="Quickview" class="quick-view">--}}
                                        {{--<i class="fa fa-eye"></i>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                                {{--<span class="product-icon sale-icon">sale!</span>--}}
                            {{--</div>--}}
                            {{--<div class="product-info">--}}
                                {{--<a href="./detail.html" title="product" class="product-name">Grouper Business card</a>--}}
                                {{--<div class="price-box">--}}
                                    {{--<span class="normal-price">$ 9.00</span>--}}
                                {{--</div>--}}
                                {{--<div class="rating-box">--}}
                                    {{--<i class="fa fa-star"></i>--}}
                                    {{--<i class="fa fa-star"></i>--}}
                                    {{--<i class="fa fa-star-half-o"></i>--}}
                                    {{--<i class="fa fa-star-o"></i>--}}
                                    {{--<i class="fa fa-star-o"></i>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-3 col-lg-3 col-sm-4 col-xs-6">--}}
                            {{--<div class="product-image-action pro-item">--}}
                                {{--<img src="./images/product/263x263/1.jpg" alt="Grouper Business card" />--}}
                                {{--<div class="action">--}}
                                    {{--<button type="button" data-toggle="tooltip" data-placement="top" class="add-to-cart gbtn" title="Add to cart">--}}
                                        {{--<i class="fa fa-shopping-cart"></i>--}}
                                    {{--</button>--}}
                                    {{--<a href="#" data-toggle="tooltip" data-placement="top" title="Wishlist" class="add-to-wishlist">--}}
                                        {{--<i class="fa fa-heart"></i>--}}
                                    {{--</a>--}}
                                    {{--<a href="#" data-toggle="tooltip" data-placement="top" title="compare" class="add-to-compare">--}}
                                        {{--<i class="fa fa-refresh"></i>--}}
                                    {{--</a>--}}
                                    {{--<a href="#" data-toggle="tooltip" data-placement="top" title="Quickview" class="quick-view">--}}
                                        {{--<i class="fa fa-eye"></i>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                                {{--<span class="product-icon sale-icon">sale!</span>--}}
                            {{--</div>--}}
                            {{--<div class="product-info">--}}
                                {{--<a href="./detail.html" title="product" class="product-name">Grouper Business card</a>--}}
                                {{--<div class="price-box">--}}
                                    {{--<span class="normal-price">$ 9.00</span>--}}
                                {{--</div>--}}
                                {{--<div class="rating-box">--}}
                                    {{--<i class="fa fa-star"></i>--}}
                                    {{--<i class="fa fa-star"></i>--}}
                                    {{--<i class="fa fa-star-half-o"></i>--}}
                                    {{--<i class="fa fa-star-o"></i>--}}
                                    {{--<i class="fa fa-star-o"></i>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="row products-grid category-product">
                            <div class="col-md-12">
                                <ul>
                                    @if(!empty($specialCategories))
                                        @foreach($specialCategories as $key=>$item)
                                            <li class="pro-item col-md-3 col-sm-4 col-xs-6">
                                                <div class="category-image">
                                                    <a href="{{$item->category->children->count()>0?route('subcategory',$item->category->id):route('category.template',$item->category->id)}}" title="Select">
                                                        <img src="{{$item->category->image?$item->category->image:'/images/product/263x263/no-image.jpg'}}" alt="Grouper Business card" />
                                                    </a>
                                                </div>
                                                <div class="product-info">
                                                    {{$item->category->name}}
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section><!--Home Promotions Products : End -->

        <!--Home Trust : Begin-->
        <section class=" trust-section">
            <div class="container trust-w inview">
                <div class="row">
                    <div class="col-md-3 col-sm-6 block-trust trust-col-quantity ">
                        <div class="tr-icon"><i class="fa fa-thumbs-up"></i></div>
                        <div class="tr-text">
                            <h3>Quality Printing</h3>
                            <span class="tr-line"></span>
                            <p>High quality printing is ensured through the use of sate of the art technology combined with finest quality printing materials.</p>
                            <a href="#" class="btn-readmore" title="Quality Printing">Read more</a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 block-trust trust-col-time-delivery">
                        <div class="tr-icon"><i class="fa fa-paper-plane"></i></div>
                        <div class="tr-text">
                            <h3>Timely Delivery</h3>
                            <span class="tr-line"></span>
                            <p>DGD Print offers best quality products within the shortest possible time and promises timely delivery.</p>
                            <a href="#" class="btn-readmore" title="Timely Delivery">Read more</a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 block-trust trust-col-eco-minded">
                        <div class="tr-icon"><i class="fa fa-leaf"></i></div>
                        <div class="tr-text">
                            <h3>Eco-Minded</h3>
                            <span class="tr-line"></span>
                            <p>
                                Our eco-friendly practice using waterless technology reflects our commitment to preserve a greener environment.
                            </p>
                            <a href="#" class="btn-readmore" title="Eco-Minded">Read more</a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 block-trust trust-col-eco-money">
                        <div class="tr-icon"><i class="fa fa-money"></i></div>
                        <div class="tr-text">
                            <h3>Money Back Guaranteed</h3>
                            <span class="tr-line"></span>
                            <p>
                                We value the trust you put on us with the job and the money you invest and try to exceed your expectations, Otherwise we refund you.
                            </p>
                            <a href="#" class="btn-readmore" title="Eco-Minded">Read more</a>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--Home Trust : End-->

        <!--Home make print : Begin -->
        <section class=" home-make-print-section">
            <div class="container home-make-print">
                <div class="row">
                    <div class="block-title-w">
                        <h2 class="block-title">HOW WE MAKE PRINTING AS EASY</h2>
                        <span class="icon-title">
							<span></span>
							<i class="fa fa-star"></i>
						</span>
                    </div><!--make print Title : End -->
                    <div class="print-content">
                        <div class="col-md-4 col-sm-4 print-block print-block-left">
                            <div class="w-print-block frist">
                                <div class="print-icon">
                                    <i class="fa fa-hand-o-up"></i>
                                    <i class="fa fa-newspaper-o"></i>
                                </div>
                                <div class="print-title">
                                    <a href="#">Select Options</a>
                                </div>
                                <div class="print-number">
                                    <span>01</span>
                                </div>
                                <div class="print-txt">
                                    <p>Choose your needed options to get your desired printing jobs done like never before.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 print-block print-block-center">
                            <div class="w-print-block">
                                <div class="print-icon">
                                    <i class="fa fa-file-text-o"></i>
                                    <i class="fa fa-arrow-circle-o-up"></i>
                                </div>
                                <div class="print-title">
                                    <a href="#">Upload your design</a>
                                </div>
                                <div class="print-number">
                                    <span>02</span>
                                </div>
                                <div class="print-txt">
                                    <p>Upload your finished design here and we will print it the way you want.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 print-block print-block-right">
                            <div class="w-print-block">
                                <div class="print-icon">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                                <div class="print-title">
                                    <a href="#">Checkout & Order</a>
                                </div>
                                <div class="print-number">
                                    <span>03</span>
                                </div>
                                <div class="print-txt">
                                    <p>Checkout and complete your order easily and conveniently with one-step checkout extension.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg_make_print hidden-xs">

                </div>
            </div>
        </section>
        <!--Home capabilitie : Begin -->
        <section class="home-capabititie-section">
            <div class="container home-capabititie">
                <div class="row">
                    <div class="block-title-w">
                        <h2 class="block-title">our capabilities</h2>
                        <span class="sub-title">We rely on our capabilities to deliver you the highest standard of quality products at the most competitive price.</span>
                        <span class="icon-title">
							<span></span>
							<i class="fa fa-star"></i>
						</span>
                    </div>
                    <div class="block-capabititie-w">
                        <div class="block-capabititie col-md-3 col-sm-3 col-xs-12">
                            <div class="block-mydoughnut" id="myDoughnut"> </div>
                            <h2 class="title">huge quantity</h2>
                            <div class="decs">
                                <p>We have the expertise and infrastructure and competent professionals to deliver large quantity of
                                    products within expected timeframe.</p>
                            </div>
                        </div>
                        <div class="block-capabititie col-md-3 col-sm-3 col-xs-12">
                            <div class="block-mydoughnut" id="myDoughnut2"> </div>
                            <h2 class="title">on Time</h2>
                            <div class="decs">
                                <p>Our customers trust us for keeping our promise to deliver products and service on time.</p>
                            </div>
                        </div>
                        <div class="block-capabititie col-md-3 col-sm-3 col-xs-12">
                            <div class="block-mydoughnut" id="myDoughnut3"> </div>
                            <h2 class="title">True Color</h2>
                            <div class="decs">
                                <p>We use true and vibrant colors to make your message visually appealing to your audience.</p>
                            </div>
                        </div>
                        <div class="block-capabititie col-md-3 col-sm-3 col-xs-12">
                            <div class="block-mydoughnut" id="myDoughnut4"> </div>
                            <h2 class="title">fast Delivery</h2>
                            <div class="decs">
                                <p>Our fastest turnaround time is achieved by delivering fast.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Home Testimonials : Begin -->
        <section class="home-testimonial-section">
            <div class="container home-testimonial">
                <div class="row">
                    <div class="tes-block" id="testimonial">
                        <div class="slider-inner">
                            <div class="wrap-item">
                                <div class="item">
                                    <div class="inner">
                                        <div class="image">
                                            <a href="#"><img class="img-circle" width="158" height="158"  src="./images/dgd-owner1.jpg" alt="terminal-01" /></a>
                                        </div>
                                        <div class="tes-name">
                                            <a href="#">Monirul Islam</a>
                                        </div>
                                        <div class="tes-job">
                                            <span>Web Designe</span>
                                        </div>
                                        <div class="tes-decs">
                                            <p>This PSD is so well organised - the best Ive ever downloaded from here. The ideas are also really fresh and new - great work. I cant wait to start work with it!</p>
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="item">--}}
                                    {{--<div class="inner">--}}
                                        {{--<div class="image">--}}
                                            {{--<a href="#"><img src="./images/testimonials/2.png" alt="terminal-01" /></a>--}}
                                        {{--</div>--}}
                                        {{--<div class="tes-name">--}}
                                            {{--<a href="#">Sam Ibister</a>--}}
                                        {{--</div>--}}
                                        {{--<div class="tes-job">--}}
                                            {{--<span>Web Designe</span>--}}
                                        {{--</div>--}}
                                        {{--<div class="tes-decs">--}}
                                            {{--<p>This PSD is so well organised - the best Ive ever downloaded from here. The ideas are also really fresh and new - great work. I cant wait to start work with it!</p>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="item">--}}
                                    {{--<div class="inner">--}}
                                        {{--<div class="image">--}}
                                            {{--<a href="#"><img src="./images/testimonials/3.png" alt="terminal-01" /></a>--}}
                                        {{--</div>--}}
                                        {{--<div class="tes-name">--}}
                                            {{--<a href="#">Sam Ibister</a>--}}
                                        {{--</div>--}}
                                        {{--<div class="tes-job">--}}
                                            {{--<span>Web Designe</span>--}}
                                        {{--</div>--}}
                                        {{--<div class="tes-decs">--}}
                                            {{--<p>This PSD is so well organised - the best Ive ever downloaded from here. The ideas are also really fresh and new - great work. I cant wait to start work with it!</p>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    {{--@if(!empty($specialCategories))--}}
        {{--<section class="home-category">--}}
            {{--<div class="container">--}}
                {{--<div class="row">--}}
                    {{--@foreach($specialCategories as $item)--}}
                        {{--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 block block-center" style="margin-bottom: 30px;">--}}
                            {{--<div class="inner-top">--}}
                                {{--<div class="box-right">--}}
                                    {{--<a href="#" class="image">--}}
                                        {{--<img src="./images/banner/category/2.jpg" alt="banner-category" />--}}
                                    {{--</a>--}}
                                    {{--<div class="info">--}}
                                        {{--<a href="#">{{$item->category->name}}</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--@endforeach--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</section>--}}
    {{--@endif--}}

@stop
