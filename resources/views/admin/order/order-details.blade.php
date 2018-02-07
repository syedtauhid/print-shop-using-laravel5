@extends('admin.template.layout')
@section('title')
    Order | Detail | Admin
@stop
@section('page-specific-css')
    <link rel="stylesheet" href="/dropify/css/dropify.min.css">
@stop
@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
            <h4 class="page-title">Order Detail</h4>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-6">
            <button style="float: right;" class="btn btn-success" data-toggle="modal" data-target="#actionModal">Change Status</button>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
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
                <h2 class="m-b-0 m-t-0">Order <small>#{{trans('orderStatus.'.$data->status)}}</small></h2>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <dl class="dl-horizontal">
                            <dt>Name</dt>
                            <dd>{{$data->orderProduct->name}}</dd>
                            <dt>Id</dt>
                            <dd>{{$data->id}}</dd>
                            <dt>Job Number</dt>
                            <dd>{{$data->job_number}}</dd>
                            <dt>Status</dt>
                            <dd>{{trans('orderStatus.'.$data->status)}}</dd>
                            <dt>Shipping  Method</dt>
                            <dd>{{$data->orderShippingMethod->method}}</dd>
                            <dt>User Id</dt>
                            <dd>{{$data->user_id}}</dd>
                            <dt>User Name</dt>
                            <dd>{{$data->user->name}}</dd>
                            <dt>Email</dt>
                            <dd>{{$data->user->email}}</dd>
                            <dt>Mobile</dt>
                            <dd>{{$data->user->userInfo?$data->user->userInfo->phone:null}}</dd>
                        </dl>
                    </div>
                    <div class="col-sm-6">
                        <dl class="dl-horizontal">
                            <dt>Price</dt>
                            <dd>{{$data->price}}</dd>
                            <dt>Shipping Cost</dt>
                            <dd>{{$data->shipping_cost}}</dd>
                            <dt>Tax</dt>
                            <dd>{{$data->tax}}</dd>
                            <dt>Discount</dt>
                            <dd>{{$data->discount}}</dd>
                            <dt>Extra Charge</dt>
                            <dd>{{$data->extra_charge}}</dd>
                            <hr>
                            <dt>Total</dt>
                            <dd>{{$data->total}}</dd>
                        </dl>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <div class="">
                    <h2 class="m-b-0 m-t-0">{{$data->orderProduct->name}}</h2>
                    @php
                        $productInfo = json_decode($data->orderProduct->product_info);
                        $productData = [];
                    @endphp
                    <hr>
                    <div class="row">
                        @if($productInfo)
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                @foreach($productInfo as $key=>$item)
                                    @if(\App\Helper::checkImage($item))
                                        <div class="thumbnail">
                                            <a href="{{$item}}">
                                                <img src="{{$item}}" alt="Nature" style="width:100%">
                                                <div class="caption">
                                                    <p>{{$key}}</p>
                                                </div>
                                            </a>
                                        </div>
                                    @else
                                        @php
                                            $productData[$key]=$item;
                                        @endphp
                                    @endif
                                @endforeach
                                {{--<div class="white-box text-center"> <img src="/images/banner-faq.jpg" class="img-responsive"> </div>--}}
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-6">
                                <h4 class="box-title ">Product description</h4>
                                <ul class="list-icons">
                                    <li><i class="fa fa-check text-success"></i> <b>Category: </b> {{$data->orderProduct->category->parent?$data->orderProduct->category->parent->name.' > '.$data->orderProduct->category->name:$data->orderProduct->category->name}}</li>
                                    <li><i class="fa fa-check text-success"></i> <b>Quantity: </b>{{$data->orderProduct->quantity}}</li>
                                    @if($productData)
                                        @foreach(array_reverse($productData) as $key=>$item)
                                            <li><i class="fa fa-check text-success"></i> <b>{{$key}}: </b>{{$item}}</li>
                                            @break($key=='total_price')
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        @endif
                        @if($data->orderProduct->admin_upload)
                            @php
                                $adminUpload = json_decode($data->orderProduct->admin_upload);
                            @endphp
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h3 class="box-title m-t-40">Uploaded By Admin</h3>
                                <hr>
                                @foreach(array_reverse($adminUpload) as $item)
                                <div class="row" style="padding: 0 30px;">
                                    <p class="box-title">Uploaded at {{$item->created_at}}</p>
                                    <hr>
                                    @foreach($item as $key=>$baby)
                                        @continue($key=='created_at')
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="thumbnail">
                                                <a href="{{$baby}}">
                                                    <img src="{{$baby}}" alt="Nature" style="width:100%">
                                                    <div class="caption">
                                                        <p>{{$key}}</p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        @endif
                        @if($data->orderShipInfo)
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h3 class="box-title m-t-40">Shipping Info</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                        @php
                                            $shipInfo = $data->orderShipInfo->toArray();
                                        @endphp
                                        @foreach($shipInfo as $key=>$item)
                                            <tr>
                                                <td width="390">{{$key}}</td>
                                                <td>{{$item}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="white-box">
                <h2 class="m-b-0 m-t-0">Order History</h2>
                <hr>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data->orderLogs as $item)
                            <tr>
                                <td>{{$item->status}}</td>
                                <td>{{$item->created_at->diffForHumans()}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

            </div>
        </div>
        <div class="col-sm-6">
            <div class="white-box">
                <h2 class="m-b-0 m-t-0">Order Review</h2>
                <hr>
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    @if($data->orderProduct->orderReview->count()>0)
                        @foreach($data->orderProduct->orderReview as $key=>$item)
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading{{$key}}">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
                                            Review #{{$key+1}}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse{{$key}}" class="panel-collapse collapse {{$key==0?'in':''}}" role="tabpanel" aria-labelledby="heading{{$key}}">
                                    <div class="panel-body">
                                        {!! $item->review !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="white-box">
                <h2 class="m-b-0 m-t-0">Action</h2>
                <hr>
                <button class="btn btn-success" data-toggle="modal" data-target="#actionModal">Change Status</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="actionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">
                        @if($data->status=="new")
                            Upload Your Design
                        @elseif($data->status=="prog-review")
                            Upload Your Reviewed Design
                        @elseif($data->status=="prog-upload")
                            {{trans('orderStatus.prog-upload')}}
                        @elseif($data->status=="approved")
                            Mark As Production Order
                        @elseif($data->status=="production")
                            @if($data->orderShippingMethod->method=="pick")
                                Pick from store
                            @else
                                Send order in ship
                            @endif
                        @elseif($data->status=="pick"||$data->status=="ship")
                            Mark as complete order
                        @endif
                    </h4>
                </div>
                <div class="modal-body">
                    @php
                        $categoryUpload = $data->orderProduct->category->parent?$data->orderProduct->category->parent->categoryUpload:$data->orderProduct->category->categoryUpload;
                    @endphp
                    @if($data->status=="new"||$data->status=="prog-review")
                        {!! Form::open(array('method'=>'post','route'=>['admin.order.post.'.$data->status,$data->id,$data->orderProduct->id],'files'=>'ture','class'=>'')) !!}
                            @if($categoryUpload)
                                @foreach($categoryUpload as $item)
                                    @if($item->field_type=="file")
                                        <div class="form-group">
                                            <label for="{{$item->label}}">{{$item->label}}:</label>
                                            <input type="file" name="{{str_replace(' ','_',$item->label)}}"   class="dropify form-control" required>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                            <button type="submit" class="btn btn-default">Submit</button>
                        {!! Form::close() !!}
                    @elseif($data->status=="prog-upload")
                        <p class="text-center">Design is uploaded for customer review</p>
                    @elseif($data->status=="approved")
                        <h4 class="text-center"> Order is approved by customer. Push this order to production.</h4>
                        <p class="text-center" style="padding: 5px;">
                            <a class="btn btn-success" href="{{route('admin.order.to.production',$data->id)}}" style="">Order in Production</a>
                        </p>
                    @elseif($data->status=="production")
                        @if($data->orderShippingMethod->method=="pick")
                            <h4 class="text-center">Change order status to pick from store</h4>
                            <p class="text-center" style="padding: 5px;">
                                <a class="btn btn-success" href="{{route('admin.order.to.pick-ship',[$data->id,'pick'])}}" style="">Pick from store</a>
                            </p>
                        @else
                            <h4 class="text-center">Send order to shipment and change status to shipment</h4>
                            <p class="text-center" style="padding: 5px;">
                                <a class="btn btn-success" href="{{route('admin.order.to.pick-ship',[$data->id,'ship'])}}" style="">Order in ship</a>
                            </p>
                        @endif
                    @elseif($data->status=="pick"||$data->status=="ship")
                        <h4 class="text-center">Mark this order as complete</h4>
                        <p class="text-center" style="padding: 5px;">
                            <a class="btn btn-success" href="{{route('admin.order.to.complete',$data->id)}}" style="">Complete Order</a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
@section('page-specific-js')
<script src="/dropify/js/dropify.min.js"></script>
<script>
    $(document).ready(function () {
        $('.dropify').dropify();
    });
</script>
@stop