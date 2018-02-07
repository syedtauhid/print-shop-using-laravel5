@extends('admin.template.layout')
@section('title')
    Special Category
@stop
@section('page-specific-css')
@stop
@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Special Category</h4>
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
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-default" href="{{route('admin.special.category.create')}}"> Add New </a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Status</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(!empty($data))
                                    @foreach($data as $item)
                                        <tr>
                                            <td> {{$item->category->name}} </td>
                                            <td> {{$item->status?'Active':'Disabled'}} </td>
                                            <td class="text-nowrap">
                                                @if($item->status)
                                                    <a class="btn btn-warning btn-circle " href="{{route('admin.special.category.status',$item->id)}}" data-toggle="tooltip" data-original-title="Disable">
                                                        <i class="fa fa-stop "></i>
                                                    </a>
                                                @else
                                                    <a class="btn btn-success btn-circle " href="{{route('admin.special.category.status',$item->id)}}" data-toggle="tooltip" data-original-title="Active">
                                                        <i class="fa fa-play "></i>
                                                    </a>
                                                @endif
                                                <a class="btn btn-danger btn-circle " href="{{route('admin.special.category.delete',$item->id)}}" data-toggle="tooltip" data-original-title="delete">
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
        </div>
    </div>
@stop