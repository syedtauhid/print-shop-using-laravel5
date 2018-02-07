@extends('admin.template.layout')
@section('title')
    Template
@stop
@section('page-specific-css')

@stop
@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Template</h4>
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
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title" style="margin-bottom: 20px;">
                    <a class="btn btn-default" href="{{route('admin.template.create')}}"> Add New </a>
                </h3>
                <div class="table-responsive">
                    <table id="productTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(count($data)>0)
                                @foreach($data as $item)
                                    <tr>
                                        <td><img src="{{$item->image}}" width="100"> </td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->category->name}}</td>
                                        <td>
                                            <a class="btn btn-danger btn-circle deleteTemplate" href="{{route('admin.template.destroy',$item->id)}}" data-toggle="tooltip" data-original-title="delete">
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
    <div id="deleteCategory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Delete <span id="categoryName"></span></h4>
                </div>
                <form method="post" class="deleteModal" data-baseurl="{{env('APP_URL')}}" action="">
                    {!! Form::token() !!}
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="checkbox checkbox-success">
                                <input id="checkbox1" type="checkbox" required>
                                <label for="checkbox1"> Are you sure?</label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('page-specific-js')
<script>
    $(document).ready(function () {
       $('#productTable').DataTable();

        $(document).on('click','.deleteTemplate',function (e) {
            if(confirm('Are you sure?')){

            }else{
                e.preventDefault();
            }
        })
    });
</script>
@stop