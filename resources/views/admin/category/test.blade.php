@extends('admin.template.layout')
@section('title')
    Category Upload Info
@stop
@section('page-specific-css')

@stop
@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Test</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            {{--<ol class="breadcrumb">--}}
            {{--<li><a href="#">Dashboard</a></li>--}}
            {{--</ol>--}}
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                @if(!empty($data))
                    @foreach($data as $item)
                        @if($item->field_type=='file')
                            <input type="{{$item->field_type}}">
                        @elseif($item->field_type=='text')
                            <input type="{{$item->field_type}}">
                        @elseif($item->field_type=='check')

                        @elseif($item->field_type=='select')

                        @elseif($item->field_type=='radio')
                            @foreach(json_decode($item->values) as $key=>$value)
                                @if($key==0)
                                    <input type="{{$item->field_type}}" name="gender" value="{{$value}}" checked> {{$value}}<br>
                                @else
                                    <input type="{{$item->field_type}}" name="gender" value="{{$value}}"> {{$value}}<br>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                @endif

            </div>
        </div>
    </div>
@stop
@section('page-specific-js')

@stop