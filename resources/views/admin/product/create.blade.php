@extends('admin.template.layout')
@section('title')
    Template Create
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
                        {!! Form::open(array('method'=>'post','route'=>'admin.template.store','files'=>'ture','class'=>'form-material form-horizontal')) !!}

                        <div class="form-group">
                            <label class="col-md-12">Name</label>
                            <div class="col-md-12">
                                <input name="name" id="name" type="text" class="form-control form-control-line" placeholder="name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12">Select Category</label>
                            <div class="col-sm-12">
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="" selected disabled>Select Any</option>
                                    @foreach($categoryTree as $item)
                                        @if(count($item->children)>0)
                                            <optgroup label="{{$item->name}}">
                                                @foreach($item->children as $baby)
                                                    <option value="{{$baby->id}}">{{$baby->name}}</option>
                                                @endforeach
                                            </optgroup>
                                        @else
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="upload-element">

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
            $(document).on('change','#category_id',function () {
               var selectedVal = $(this).val();
                var url = '{{env("APP_URL")}}'+'/admin/category/'+selectedVal+'/upload-info-json';
                console.log(url);
                $.ajax({
                    type : 'GET',
                    url : url,
                    success:function(data){
                        console.log(data);
                        var html='';
                        for(var i=0;i<data.length;i++){
                            if(data[i]['field_type']=='file'){
                                html+=uploadFileHtml(data[i]['label']);
                            }
                        }
                        $('.upload-element').html(html);
                    }

                });
            });

            function uploadFileHtml(name) {
              return '<div class="form-group">'+
                        '<label class="col-sm-12">'+name+'</label>'+
                        '<div class="col-sm-6">'+
                            '<div class="fileinput fileinput-new input-group" data-provides="fileinput">'+
                                '<div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>'+
                                    '<span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>'+
                                    '<input type="file" name="'+name+'" required>'+
                                    '</span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>'+
                                '</div>'+
                        '</div>'+
                        '<div class="col-sm-6">'+
                            '<label class="radio-inline p-0">'+
                            '<div class="radio radio-info">'+
                                '<input type="radio" name="radio" id="radio1" value="'+name+'" checked>'+
                                '<label for="radio1">Set as default</label>'+
                            '</div>'+
                            '</label>'+
                        '</div>'+
                    '</div>';
            }
        });
    </script>
@stop