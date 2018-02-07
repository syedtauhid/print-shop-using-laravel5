@extends('admin.template.layout')
@section('title')
    Category Press Info
@stop
@section('page-specific-css')
    <style>
        .extra-value-field input{
            margin-bottom: 25px;
        }
        .well-label{
            padding-bottom: 15px;
            border-bottom: 1px dotted #eee;
        }
    </style>
@stop
@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Details of</h4>
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

                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class=""><a  href="{{route('admin.category.upload-info',$id)}}" ><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Upload Info</span></a></li>
                    <li role="presentation" class=""><a href="{{route('admin.category.print-info',$id)}}" ><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">Print Info</span></a></li>
                    <li role="presentation" class=""><a href="{{route('admin.category.press-info',$id)}}"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Press Info</span></a></li>
                    <li role="presentation" class="active"><a ><span class="visible-xs"><i class="ti-settings"></i></span> <span class="hidden-xs">Price Map</span></a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active">

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 well">
                                    <h3 class="text-center well-label"> Mark Price Dependency Field</h3>
                                    @php
                                        $checkedDependency = $categoryDetails->categoryPriceDependency?$categoryDetails->categoryPriceDependency->pluck('category_press_id')->toArray():[];
                                    @endphp
                                    @if(count($categoryDetails->categoryPress))
                                    <form class="" method="post" action="{{route('admin.category.price-map-dependency',[$id])}}">
                                        {!! Form::token() !!}
                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                            @foreach($categoryDetails->categoryPress as $item)
                                                <label class="checkbox-inline">
                                                        {{ Form::checkbox('category_press_id[]', $item->id, in_array($item->id,$checkedDependency)) }}
                                                     {{$item->label}}
                                                </label>
                                            @endforeach
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" id="dependencySave" class="btn btn-success">Save</button>
                                        </div>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        @if(count($categoryDetails->categoryPriceMap))
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 well">
                                    <h3 class="text-center well-label"> Added Field </h3>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                @foreach(json_decode($categoryDetails->categoryPriceMap[0]->price) as $key=>$item)
                                                    <th>{{$key}}</th>
                                                @endforeach
                                                <th class="text-nowrap">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(!empty($categoryDetails->categoryPriceMap))
                                                @foreach($categoryDetails->categoryPriceMap as $key=>$item)
                                                    <tr>
                                                        @foreach(json_decode($item->price) as $baby)
                                                            <td> {{$baby}} </td>
                                                        @endforeach
                                                        <td class="text-nowrap">
                                                            <a class="btn btn-danger btn-circle " href="{{route('admin.category.price-map.delete',$item->id)}}" data-toggle="tooltip" data-original-title="delete">
                                                                <i class="fa fa-close "></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 well">
                                @if($categoryDetails->categoryPriceDependency)
                                    <form class="" method="post" action="{{route('admin.category.price-map.store',[$id])}}">
                                        {!! Form::token() !!}
                                        @foreach($categoryDetails->categoryPriceDependency as $item)

                                            <div class="{{count($categoryDetails->categoryPriceDependency)>6?'col-md-2':'col-md-'.(integer)(12/(count($categoryDetails->categoryPriceDependency)+1))}}">
                                                @if($item->categoryPress->field_type=='text')
                                                    <div class="form-group">
                                                        @if(!empty($item->categoryPress->label))
                                                            <label for="{{str_replace(' ', '_', $item->placeholder)}}">{{$item->categoryPress->label}}</label>
                                                        @endif
                                                        <input class="form-control" name="{{str_replace(' ', '_', $item->categoryPress->placeholder)}}" type="text" id="{{str_replace(' ', '_', $item->categoryPress->placeholder)}}" placeholder="{{$item->placeholder}}" required>
                                                    </div>
                                                @elseif($item->categoryPress->field_type=='checkbox')
                                                    <div class="form-group padding-left-right">
                                                        @if(!empty($item->categoryPress->label))
                                                            <label for="{{str_replace(' ', '_', $item->placeholder)}}">{{$item->categoryPress->label}}</label><br>
                                                        @endif
                                                        @foreach(json_decode($item->categoryPress->values) as $key=>$value)
                                                            @if($key==0)
                                                                <label class="checkbox-inline">
                                                                    <input type="checkbox" name="{{str_replace(' ', '_', $item->categoryPress->placeholder)}}" value="{{$value}}" checked>{{$value}}
                                                                </label>
                                                                {{--<input class="inline" type="{{$item->field_type}}" name="gender" value="{{$value}}" checked> {{$value}}<br>--}}
                                                            @else
                                                                {{--<input class="inline" type="{{$item->field_type}}" name="gender" value="{{$value}}"> {{$value}}<br>--}}
                                                                <label class="checkbox-inline">
                                                                    <input type="checkbox" name="{{str_replace(' ', '_', $item->categoryPress->placeholder)}}" value="{{$value}}" >{{$value}}
                                                                </label>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @elseif($item->categoryPress->field_type=='select')
                                                    @if(!empty($item->categoryPress->label))
                                                        <label for="{{str_replace(' ', '_', $item->categoryPress->placeholder)}}">{{$item->categoryPress->label}}</label><br>
                                                    @endif
                                                    <select name="{{str_replace(' ', '_', $item->categoryPress->placeholder)}}" class="form-control" id="{{str_replace(' ', '_', $item->categoryPress->placeholder)}}" required>
                                                        <option value="" selected disabled>Select Any</option>
                                                        @foreach(json_decode($item->categoryPress->values) as $key=>$value)
                                                            <option value="{{$value}}">{{$value}}</option>
                                                        @endforeach
                                                    </select>
                                                @elseif($item->categoryPress->field_type=='radio')
                                                    <div class="form-group padding-left-right">
                                                        <label for="{{str_replace(' ', '_', $item->categoryPress->placeholder)}}">{{$item->categoryPress->label}} </label><br>
                                                        @foreach(json_decode($item->categoryPress->values) as $key=>$value)
                                                            @if($key==0)
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="{{str_replace(' ', '_', $item->categoryPress->placeholder)}}" value="{{$value}}" checked>{{$value}}
                                                                </label>
                                                                {{--<input class="inline" type="{{$item->field_type}}" name="gender" value="{{$value}}" checked> {{$value}}<br>--}}
                                                            @else
                                                                {{--<input class="inline" type="{{$item->field_type}}" name="gender" value="{{$value}}"> {{$value}}<br>--}}
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="{{str_replace(' ', '_', $item->categoryPress->placeholder)}}" value="{{$value}}" >{{$value}}
                                                                </label>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div class="form-group">
                                                        @if(!empty($item->categoryPress->label))
                                                            <label for="{{str_replace(' ', '_', $item->categoryPress->placeholder)}}">{{$item->categoryPress->label}}</label>
                                                        @endif
                                                        <input class="form-control" name="{{str_replace(' ', '_', $item->categoryPress->placeholder)}}" type="{{$item->categoryPress->field_type}}" id="{{str_replace(' ', '_', $item->categoryPress->placeholder)}}" placeholder="{{$item->categoryPress->placeholder}}" required>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                        <div class="{{count($categoryDetails->categoryPriceDependency)>6?'col-md-2':'col-md-'.(integer)(12/(count($categoryDetails->categoryPriceDependency)+1))}}">
                                            <div class="form-group">
                                                <label for="price">Price</label>
                                                <input class="form-control" name="price" type="text" id="price" placeholder="price" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-default">Submit</button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop
@section('page-specific-js')
    <script>
        $(document).ready(function () {
            var extraValueFieldNo = 0;
            $('#field-type').on('change',function () {
                extraValueFieldNo = 0;
                $('.extra-value-field').empty();

                var fieldValue = $(this).val();
                var requireValueFieldForInputType = ['select','radio','checkbox'];
                console.log($.inArray(fieldValue,requireValueFieldForInputType));
                if($.inArray(fieldValue,requireValueFieldForInputType)>-1){
                    $('.value-field').removeClass('hidden');
                }else{
                    $('.value-field').removeClass('hidden').addClass('hidden');
                }
            });

            $(document).on('click','#add-value-field',function(){
                extraValueFieldNo +=1;
                var extraValueFieldHtml = '<div class="col-md-8">'+
                        '<input type="text" class="form-control" name="values['+extraValueFieldNo+']">'+
                        '</div>';
                $('.extra-value-field').append(extraValueFieldHtml);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#dependencySave').click(function(e) {
                var countPriceMap = '<?php echo count($categoryDetails->categoryPriceMap)?>';
                if(countPriceMap>0){
                    if (confirm('If you change price dependency, all of your price map will be deleted.' +
                                    'Are you want to proceed?')) {

                    }else{
                        e.preventDefault();
                    }
                }
            });
        });
    </script>
@stop