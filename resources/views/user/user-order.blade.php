@extends('user.template.layout')
@section('title')
    Home
@stop
@section('page-specific-css')
    <link rel="stylesheet" href="{{asset('css/summernote.css')}}">
@stop
@section('content')
    <section >
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
                            <span>My Order</span>
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
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> {{session()->pull('success')}}.
                </div>
            @elseif(session()->has('errors'))
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <ul>
                        @foreach($errors->getMessages() as $error)
                            <li>{{$error[0]}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row acc-order">
                <!--Account Sidebar: End-->
                @include('user._partial.user-nav')
                <!--Account Sidebar: End-->
                <!--Account main content : Begin -->
                <section class="account-main col-md-9 col-sm-8 col-xs-12">
                    <h3 class="acc-title lg">My Current Orders</h3>
                    <div class="form-edit-info table-responsive">
                        @if($orders->count()>0)
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr class="th-header">
                                    <th>Job Name</th>
                                    <th>Submitted</th>
                                    <th colspan="2">Your Choosed Design/ Uploaded Design</th>
                                    <th colspan="2">Approved Your Design</th>
                                    <th> Approved </th>
                                    <th>In Production</th>
                                    <th>Ready To Pickup/Shipped</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                @foreach($orders as $order)
                                    <tr class="">
                                        <td>{{$order->orderProduct->name}}<br>({{$order->job_number}})
                                        </td>
                                        <td>{{date('M d, y',strtotime($order->created_at))}}</td>
                                        <td colspan="2" >
                                            @php
                                                $product =  json_decode($order->orderProduct->product_info);
                                            @endphp
                                            @foreach($product as $key=>$item)
                                                @if(\App\Helper::checkImage($item))
                                                    <p>
                                                        <label><u>{{$key}}</u></label>
                                                        <img src="{{asset($item)}}">
                                                    </p>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td colspan="2" >
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
                                                @if($order->status=="prog-upload")
                                                    <p class="btn-group inline">
                                                        <a href="{{route('order.user.accepted',$order->id)}}" class="btn btn-success btn-xs user-order user-order-confirm">Confirm Order</a>
                                                        <button data-orderid="{{$order->id}}" data-orderproductid="{{$order->orderProduct->id}}" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-info btn-xs user-order-review user-order">Edit Order</button>
                                                    </p>
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $approveTime=null;
                                                if($order->orderLogs->count()>0){
                                                    foreach ($order->orderLogs as $log){
                                                        if($log->status=="approved"){
                                                            $approveTime=$log->created_at;
                                                            break;
                                                        }
                                                    }
                                                }
                                                if($approveTime){
                                                    echo date('M d, y',strtotime($approveTime));
                                                }else{
                                                    echo '-';
                                                }
                                            @endphp
                                        </td>
                                        <td>
                                            @if($order->status=="production")
                                                WITHIN 24 HOURS.
                                                MOST OF OUR PRODUCTION IS DONE WITHIN 2-3 BUSINESS DAY HOURS
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($order->status=="pick")
                                                {{trans('orderStatus.pick')}}
                                            @elseif($order->status=="ship")
                                                {{trans('orderStatus.ship')}}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{$order->status}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <h4>No Orders Found</h4>
                        @endif
                    </div>
                </section><!-- Cart main content : End -->
            </div>

        </div>
    </section>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myLargeModalLabel">Upload Your Review</h4> </div>
                <div class="modal-body">
                    <form class="" method="post" action="{{route('user.store.review')}}" enctype="multipart/form-data">
                        {!! Form::token() !!}
                        <input type="hidden" name="order_id" id="orderId">
                        <input type="hidden" name="order_product_id" id="orderProductId">
                        <textarea name="review" class="summernote">

                        </textarea>
                        <button class="btn btn-success">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@stop
@section('page-specific-js')
    <script src="{{asset('js/summernote.min.js')}}"></script>
    <script>
        $(function () {
            var orderId,orderProductId;
            $('.summernote').summernote({
                height: 350, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: false, // set focus to editable area after initializing summernote
                onImageUpload: function(files, editor, $editable) {
                    sendFile(files[0],editor,$editable);
                }
            });

            function sendFile(file,editor,welEditable) {
                console.log(file);
                data = new FormData();
                data.append("file", file);
                data.append("order_id",orderId);
                data.append("_token",'{{csrf_token() }}');
                $.ajax({
                    url: "{{route('user.review.store.image')}}",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function(data){
                        console.log(data);
                        $('.summernote').summernote('insertImage',data, function ($image) {
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus+" "+errorThrown);
                    }
                });
            }

            $("#proof_info").addClass('active');
            $(document).on('click','.user-order-review',function () {
               $('#orderId').val($(this).data('orderid'));
               $('#orderProductId').val($(this).data('orderproductid'));
                orderId = $(this).data('orderid');
                orderProductId = $(this).data('orderproductid');
            });
        })
    </script>
@stop
