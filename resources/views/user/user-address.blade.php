@extends('user.template.layout')
@section('title')
    Home
@stop
@section('page-specific-css')
@stop
@section('content')
    <section class="header-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 hidden-xs">
                    <h1 class="mh-title">My Account</h1>
                </div>
                <div class="breadcrumb-w col-sm-9">
                    <span class="hidden-xs">You are here:</span>
                    <ul class="breadcrumb">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li>
                            <span>My Address</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="account-content parten-bg">
        <div class="container">
            <!--Account top banner -->
            <div class="row">
                <div class="col-md-12 cart-banner-top hidden-xs">
                    <a href="#" title="cart top banner">
                        <img src="{{asset('images/banner/cart/top-banner.jpg')}}" alt="Cart top banner" />
                    </a>
                </div>
            </div><!--Account top banner : End-->
            <div class="row acc-address">
                <!--Account Sidebar: End-->
                @include('user._partial.user-nav')
                <!--Account Sidebar: End-->
                <!--Account main content : Begin -->
                <section class="account-main col-md-9 col-sm-8 col-xs-12">
                    <h3 class="acc-title lg">Address Book</h3>
                    <div class="form-edit-info">
                        <h4 class="acc-sub-title">DEFAULT ADDRESSES</h4>
                        <ul>
                            <li><span class="alabel">Name: </span><span class="avalue">Netbase</span></li>
                            <li><span class="alabel">Address: </span><span class="avalue">102580 Santa Monica Los Angeles</span></li>
                            <li><span class="alabel">Phone: </span><span class="avalue">12.123.6666</span></li>
                        </ul>
                        <a href="#" title="change Address" class="change-address">Change Address</a>
                    </div>
                </section><!-- Cart main content : End -->
            </div>

        </div>
    </section>
@stop
