@extends('user.template.layout')
@section('title')
    Template
@stop
@section('page-specific-css')
    <style>
        .padding-left-right{
            padding:0 15px;
        }
    </style>
@stop
@section('content')
    <section class="">
        <div class="container breadcumb">
            <div class="row">
                <div class="col-sm-3 hidden-xs">
                    <h1 class="mh-title">Templates</h1>
                </div>
                <div class="breadcrumb-w col-sm-9">
                    <span>You are here:</span>
                    <ul class="breadcrumb">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li>
                            <span>Business Cards</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="category-w parten-bg">
        <div class="container">
            <div class="row">
                @php
                    if($categoryDetail->parent_id){
                        $categoryUpload = $categoryDetail->parent->categoryUpload;
                    }else{
                        $categoryUpload = $categoryDetail->categoryUpload;
                    }
                @endphp
                @if(!empty($categoryUpload))
                <aside id="sidebar_cate" class="col-sm-3 col-xs-12" style="margin-bottom: 10px;">
                    <h3 class="sidebar-title">Upload your design</h3>
                    {!! Form::open(array('method'=>'post','route'=>['template.user.upload',$categoryDetail->id],'files'=>'ture','class'=>'form-material form-horizontal')) !!}
                        @foreach($categoryUpload as $key=>$item)
                            @if($item->field_type=='file')
                                <div class="box-upload">
                                    <div id="image_placeholder_{{$key}}">
                                        <span class="icon">
                                            <i class="fa fa-file-text-o"></i>
                                            <i class="fa fa-arrow-up border-radius-50"></i>
									                      </span>
                                    </div>
                                    <p>{{$item->placeholder}}</p>
                                    <input name={{str_replace(' ', '_', $item->label)}} type="{{$item->field_type}}"
                                           style="display: none" class="hidden_file_input" data-id="{{$key}}" id="file_{{$key}}" required>
                                    <button type="button" class="btn upload-btn" onclick="openChoseDialog({{$key}})">Upload</button>
                                </div>
                            @elseif($item->field_type=='text')
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{$item->label}}</label>
                                    <input class="form-control" name={{str_replace(' ', '_', $item->label)}} type="{{$item->field_type}}">
                                </div>
                            @elseif($item->field_type=='checkbox')
                                <div class="form-group padding-left-right">
                                    <label for="exampleInputEmail1">{{$item->label}} </label><br>
                                    @foreach(json_decode($item->values) as $key=>$value)
                                        @if($key==0)
                                            <label class="checkbox-inline">
                                                <input type="{{$item->field_type}}" name="{{str_replace(' ', '_', $item->label)}}" value="{{$value}}" checked>{{$value}}
                                            </label>
                                            {{--<input class="inline" type="{{$item->field_type}}" name="gender" value="{{$value}}" checked> {{$value}}<br>--}}
                                        @else
                                            {{--<input class="inline" type="{{$item->field_type}}" name="gender" value="{{$value}}"> {{$value}}<br>--}}
                                            <label class="checkbox-inline">
                                                <input type="{{$item->field_type}}" name="{{str_replace(' ', '_', $item->label)}}" value="{{$value}}" >{{$value}}
                                            </label>
                                        @endif
                                    @endforeach
                                </div>
                            @elseif($item->field_type=='select')
                                <label for="exampleInputEmail1">{{$item->label}}</label>
                                <select name="{{str_replace(' ', '_', $item->label)}}" class="form-control">
                                    @foreach(json_decode($item->values) as $key=>$value)
                                        <option value="{{$value}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            @elseif($item->field_type=='radio')
                                <div class="form-group padding-left-right">
                                    <label for="exampleInputEmail1">{{$item->label}} </label><br>
                                    @foreach(json_decode($item->values) as $key=>$value)
                                        @if($key==0)
                                            <label class="radio-inline">
                                                <input type="{{$item->field_type}}" name="{{str_replace(' ', '_', $item->label)}}" value="{{$value}}" checked>{{$value}}
                                            </label>
                                            {{--<input class="inline" type="{{$item->field_type}}" name="gender" value="{{$value}}" checked> {{$value}}<br>--}}
                                        @else
                                            {{--<input class="inline" type="{{$item->field_type}}" name="gender" value="{{$value}}"> {{$value}}<br>--}}
                                            <label class="radio-inline">
                                                <input type="{{$item->field_type}}" name="{{str_replace(' ', '_', $item->label)}}" value="{{$value}}" >{{$value}}
                                            </label>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    <button type="submit" class="btn btn-primary btn-block">Next</button>
                    {!! Form::close() !!}
                </aside>
            @endif
            <!--Category product grid : Begin -->
                <section class="category grid {{empty($categoryUpload)?'col-sm-12':'col-sm-9'}} col-xs-12">
                    <div class="row">
                        {{--<div class="col-xs-12 category-image visible-md visible-lg visible-sm visible-xs">--}}
                            {{--<a href="#" title="category image">--}}
                                {{--<img src="/images/banner/category/top-business-card-large.jpg" alt="Business card" />--}}
                                {{--<h2 class="hover-text">Business Card</h2>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-12 category-image visible-sm">--}}
                        {{--<a href="#" title="category image">--}}
                        {{--<img src="./images/banner/category/top-business-card-medium.jpg" alt="Business card" />--}}
                        {{--<h3 class="hover-text">A Movie in the Park:<br />Kung Fu Panda</h3>--}}
                        {{--</a>--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-12 category-image visible-xs">--}}
                        {{--<a href="#" title="category image">--}}
                        {{--<img src="./images/banner/category/top-business-card-small.jpg" alt="Business card" />--}}
                        {{--<h2 class="hover-text">A Movie in the Park:<br />Kung Fu Panda</h2>--}}
                        {{--</a>--}}
                        {{--</div>--}}
                        <h3 class="sidebar-title">OR choose from here</h3>
                    </div>
                    <div class="row products-grid category-product">
                        <ul>
                            @if(!empty($templates))
                                @foreach($templates as $key=>$item)
                                    <li class="pro-item col-md-4 col-sm-6 col-xs-12">
                                        <div class="category-image ">
                                            <a href="{{route('template.selected',[$categoryDetail->id,$item->id])}}" title="Select">
                                                <img src="{{$item->image?$item->image:'/images/product/263x263/no-image.jpg'}}" alt="Grouper Business card" />
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            {{$item->name}}
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </section><!-- Category product grid : End -->
            </div>
            <!-- <div class="row">
                <div class="col-md-12 visible-md visible-lg cate-bottom-banner">
                    <a href="#" title="category bottom banner">
                        <img src="/images/banner/category/category-bottom-banner-large.jpg" alt="Business card" />
                    </a>
                </div>
                <div class="col-sm-12 visible-sm cate-bottom-banner">
                    <a href="#" title="category bottom banner">
                        <img src="/images/banner/category/category-bottom-banner-medium.jpg" alt="Business card" />
                    </a>
                </div>
                <div class="col-xs-12 visible-xs cate-bottom-banner">
                    <a href="#" title="category bottom banner">
                        <img src="/images/banner/category/category-bottom-banner-small.jpg" alt="Business card" />
                    </a>
                </div>
            </div> -->
        </div>
    </section>
@stop
