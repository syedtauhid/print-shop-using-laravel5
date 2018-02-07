@extends('admin.template.layout')
@section('title')
    Category Create
@stop
@section('page-specific-css')

@stop
@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Add New Category</h4>
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
            <div class="white-box p-l-20 p-r-20">
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
                <div class="row">
                    <div class="col-md-12">


                        {!! Form::open(array('method'=>'post','route'=>'admin.category.store','files'=>'ture','class'=>'form-material form-horizontal')) !!}

                            <div class="form-group">
                                <label class="col-md-12">Name</label>
                                <div class="col-md-12">
                                    <input name="name" id="name" type="text" class="form-control form-control-line" placeholder="name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Slug</label>
                                <div class="col-md-12">
                                    <input name="slug" id="slug" type="text" class="form-control form-control-line" placeholder="slug" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Select Category</label>
                                <div class="col-sm-12">
                                    <select name="parent_id" class="form-control" >
                                        <option value="0" selected> Select Category</option>
                                        @if($categories)
                                            @foreach($categories as $key=>$category)
                                                <option value="{{$key}}"> {{$category}} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Image</label>
                                <div class="col-sm-12">
                                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                        <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                        <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                        <input type="file" name="image" required>
                                        </span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('page-specific-js')
<script src="{{asset('js/library/jasny-bootstrap.js')}}"></script>
<script>
    $(document).ready(function () {
       $(document).on('keyup','#name',function () {
          var name = $('#name').val();
           name = name.trim().toLowerCase();
           name = name.replace('/[^a-z0-9\']/i',' ');
           var slug = name.replace(/\s+/mg,'-');
           $('#slug').val(slug);
       });
    });
</script>
@stop