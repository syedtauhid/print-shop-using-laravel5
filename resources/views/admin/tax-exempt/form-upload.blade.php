@extends('admin.template.layout')
@section('title')
    Category
@stop
@section('page-specific-css')
<link rel="stylesheet" href="{{asset('dropify/css/dropify.min.css')}}">
@stop
@section('content')
    <div class="row bg-title">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h4 class="page-title">Upload Tax Exempt Certificate</h4>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
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
                    @php
                        $taxForm = null;
                        if(file_exists('image/tax-exempt/tax-exempt-form.doc')){
                            $taxForm = 'image/tax-exempt/tax-exempt-form.doc';
                        }elseif (file_exists('image/tax-exempt/tax-exempt-form.docx')){
                            $taxForm = 'image/tax-exempt/tax-exempt-form.docx';
                        }
                    @endphp
                    @if($taxForm)
                        <a class="btn btn-default" href="{{asset($taxForm)}}" download> Download Current Tax Exempt Certificate</a>
                    @else
                        Upload your Tax Exempt Form
                    @endif
                </div>
                <div class="panel-body">
                    <div class="white-box">
                        {!! Form::open(array('method'=>'post','route'=>'admin.tax-exempt.store','files'=>'ture','class'=>'form-material form-horizontal')) !!}
                        <div class="form-group">
                            <input name="taxExemptForm" type="file" id="input-file-now" class="dropify" data-allowed-file-extensions="doc docx" required />
                        </div>
                        <button class="btn btn-info" type="submit">Upload</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('page-specific-js')
<script src="{{asset('dropify/js/dropify.min.js')}}"></script>
<script>
    $(document).ready(function () {
        // Basic
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop your <b>doc/docx</b> tax exempt form here or click',
                'replace': 'Drag and drop or click to replace',
                'remove':  'Remove',
                'error':   'Ooops, something wrong happended.'
            }
        });
    });
</script>
@stop