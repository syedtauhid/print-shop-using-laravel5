@extends('user.template.layout')
@section('title')
Home
@stop
@section('page-specific-css')
    <style>
        tbody{
            text-align: center;
        }
        tbody img{
            max-width: 200px;
        }
    </style>
@stop
@section('content')
    <section class="">
        <div class="container breadcumb">
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
                            <span>Order History</span>
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
            <div class="row acc-dashboard">
                <!--Account Sidebar: End-->
                @include('user._partial.user-nav')
                <!--Account Sidebar: End-->
                <!--Account main content : Begin -->
                <section class="account-main col-md-9 col-sm-8 col-xs-12">
                    <h3 class="acc-title lg">Card Information</h3>
                    <div class="form-edit-info">
                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                  <th>Job Name #</th>
                                  <th>Design</th>
                                  <th>Submitted</th>
                                  <th>Approved</th>
                                  <th>Ship Date</th>
                                  <th>Completed</th>
                                  <th>Status</th>
                              </tr>
                            </thead>
                            <tbody>
                            @if($orders)
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order->orderProduct->name}}<br>({{$order->job_number}})</td>
                                        <td>
                                            @if($order->orderProduct->admin_upload)
                                                @php
                                                    $adminUpload =  json_decode($order->orderProduct->admin_upload);
                                                    $adminUpload = end($adminUpload);
                                                @endphp
                                                @foreach($adminUpload as $key=>$item)
                                                    @if(\App\Helper::checkImage($item))
                                                        <p>
                                                            <label><u>{{$key}}</u></label>
                                                            <img src="{{asset($item)}}">
                                                        </p>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{date('M d, y',strtotime($order->created_at))}}</td>
                                        @php
                                            $logStatus = [];
                                            if($order->orderLogs->count()>0){
                                                    foreach ($order->orderLogs as $log){
                                                        if(in_array($log->status,['approved','pick','ship','completed'])){
                                                            $logStatus[$log->status] = date('M d, y',strtotime($log->created_at));
                                                        }
                                                    }
                                                }
                                        @endphp
                                        <td>{{!empty($logStatus['approved'])?$logStatus['approved']:''}}</td>
                                        <td>{{(!empty($logStatus[$order->orderShippingMethod->method]))?$logStatus[$order->orderShippingMethod->method]:''}}</td>
                                        <td>{{!empty($logStatus['completed'])?$logStatus['completed']:''}}</td>
                                        <td>Completed</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </section><!-- Cart main content : End -->
@stop
@section('page-specific-js')
    <script>
        $(function () {
            $("#order_info").addClass('active');
        })
    </script>
@stop
