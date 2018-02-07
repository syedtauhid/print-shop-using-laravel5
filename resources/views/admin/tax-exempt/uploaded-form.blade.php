@extends('admin.template.layout')
@section('title')
    Tax Exempt Form | {{$status}}
@stop
@section('page-specific-css')
@stop
@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Tax Exempt Form | {{$status}}</h4>
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
                            <th>User Name</th>
                            <th>Email</th>
                            <th>File</th>
                            <th>Status</th>
                            <th>Upload Date</th>
                            @if($status=="pending")
                                <th>Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($data)>0)
                            @foreach($data as $item)
                                <tr>
                                    <td>{{$item->user->name}}</td>
                                    <td>{{$item->user->email}}</td>
                                    <td><a href="{{asset($item->form)}}" download><u>Form</u></a></td>
                                    <td>{{$item->status}}</td>
                                    <td>{{$item->created_at->diffForHumans()}}</td>
                                    @if($status=="pending")
                                        <td>
                                            <a class="btn btn-success " href="{{route('admin.tax-exempt.change.status',[$item->id,"accepted"])}}" data-toggle="tooltip" data-original-title="Accept">
                                                Accept
                                            </a>
                                            <a class="btn btn-danger " href="{{route('admin.tax-exempt.change.status',[$item->id,"rejected"])}}" data-toggle="tooltip" data-original-title="Reject">
                                                Reject
                                            </a>
                                        </td>
                                    @endif
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
            });
        });
    </script>
@stop