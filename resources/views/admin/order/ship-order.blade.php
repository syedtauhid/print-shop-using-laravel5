@extends('admin.template.layout')
@section('title')
    Order | Ship | Admin
@stop
@section('page-specific-css')
@stop
@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Shipped Order</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">

                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Job Number</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>User Id</th>
                            <th>Template</th>
                            <th>Ship Type</th>
                            <th>Price</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($data)>0)
                            @foreach($data as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->job_number}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->catName}}</td>
                                    <td>{{$item->user_id}}</td>
                                    <td>{{$item->template_id?$item->template_id:'custom'}}</td>
                                    <td>{{$item->shipMethod}}</td>
                                    <td>{{$item->total}}</td>
                                    <td>{{$item->created_at->diffForHumans()}}</td>
                                    <td>
                                        <a class="btn btn-info btn-circle deleteTemplate" href="{{route('admin.order.detail',$item->id)}}" data-toggle="tooltip" data-original-title="details">
                                            <i class="fa fa-info "></i>
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
@stop
@section('page-specific-js')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "order": [[ 0, 'desc' ]]
            });
        });
    </script>
@stop