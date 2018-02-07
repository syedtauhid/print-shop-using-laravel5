@extends('user.template.layout')
@section('title')
Home
@stop
@section('page-specific-css')
    <link rel="stylesheet" href="{{asset('dropify/css/dropify.min.css')}}">
@stop
@section('content')
    <section class="">
        <div class="container breadcumb">
            <div class="row">
                <div class="col-sm-3 hidden-xs">
                    <h1 class="mh-title">My Account</h1>
                </div>
                <div class="breadcrumb-w col-sm-9">
                    <span class="hidden-xs">You are here:</span>
                    <ul class="breadcrumb">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li>
                            <span>Resale Certificate</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="account-content parten-bg">
        <div class="container">
            <!--Account top banner -->
            <div class="row">
                <div class="col-md-12 cart-banner-top hidden-xs">
                    <a href="#" title="cart top banner">
                        <img src="{{asset('images/banner/cart/top-banner.jpg')}}" alt="Cart top banner" />
                    </a>
                </div>
            </div><!--Account top banner : End-->
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
            <div class="row acc-dashboard">
                <!--Account Sidebar: End-->
                @include('user._partial.user-nav')
                <!--Account Sidebar: End-->
                <!--Account main content : Begin -->
                <section class="account-main col-md-9 col-sm-8 col-xs-12">
                    <h3 class="acc-title lg">Resale Certificate</h3>
                    <p>If you signed up as a reseller and have a <b>valid reseller's permit</b>, please upload it below.</p>
                    <p><span style="color: #1b6d85">California Residents:</span> You must have a valid resale number before you can place orders without paying sales tax.</p>
                    <p>If you are shipping jobs to California, please send us a <u><b>BOE230</b></u> form, so that you will not get Taxed.</p>
                    <div class="form-edit-info">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a  href="#download" data-toggle="tab">Download</a>
                            </li>
                            <li><a href="#upload" data-toggle="tab">Upload</a>
                            </li>
                            <li><a href="#status" data-toggle="tab">Status</a>
                            </li>
                        </ul>

                        <div class="tab-content ">
                            <div class="tab-pane active" id="download" style="padding: 10px;">
                                <h4>You may download the resale certificate on our Resale Certificate Download Section.</h4>
                                <p>Please fill it out and upload it here. One of our customer service representatives will validate the information, so that you will not be taxed on future orders.Please note, you will be charged tax untill we can verify the validity of your resale certificate.</p>
                                <p style="text-align: center; margin-top: 25px;">
                                    @php
                                        $taxForm = null;
                                        if(file_exists('image/tax-exempt/tax-exempt-form.doc')){
                                            $taxForm = 'image/tax-exempt/tax-exempt-form.doc';
                                        }elseif (file_exists('image/tax-exempt/tax-exempt-form.docx')){
                                            $taxForm = 'image/tax-exempt/tax-exempt-form.docx';
                                        }
                                    @endphp
                                    @if($taxForm)
                                        <a href="{{asset($taxForm)}}" class="btn btn-lg btn-primary" download>
                                            <span class="glyphicon glyphicon-circle-arrow-down"></span> Download Certificate
                                        </a>
                                    @else
                                        <button onclick="noTaxExemptFormAlert()" class="btn btn-lg btn-primary" download>
                                            <span class="glyphicon glyphicon-circle-arrow-down"></span> Download Certificate
                                        </button>
                                    @endif
                                </p>
                            </div>
                            <div class="tab-pane" id="upload" style="padding: 10px;">
                                <p>Please upload Resale Certificate here.One of our customer service representatives will validate the information, so that you will
                                    not charged tax on future orders.Please note,you will be charged tax until we can verify the validity of your resale certificate.  </p>
                                <div>
                                    {!! Form::open(array('method'=>'post','route'=>'user.tax-exempt.store','files'=>'ture','class'=>'form-material form-horizontal')) !!}
                                    <div style="padding:0 15px;" class="form-group">
                                        <input name="taxExemptForm" type="file" id="input-file-now" class="dropify" data-allowed-file-extensions="doc docx" required />
                                    </div>
                                    <button class="btn btn-info" type="submit">Upload</button>
                                    {!! Form::close() !!}

                                </div>
                            </div>
                            <div class="tab-pane" id="status">
                                <h3>Your Uploaded Resale Certificates </h3>
                                <table class="data-table" id="my-orders-table">
                                    <tbody>
                                    <tr class="">
                                        <th>Certificate</th>
                                        <th>Status</th>
                                        <th>Uploaded Date</th>
                                    </tr>
                                    @if(!empty($uploadedTaxExemptForms))
                                        @foreach($uploadedTaxExemptForms as $item)
                                            <tr class="">
                                                <td><a href="{{asset($item->form)}}" download><u>Form</u></a></td>
                                                <td>{{$item->status}}</td>
                                                <td>{{$item->created_at->diffForHumans()}}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <p>No uploaded certificates found</p>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section><!-- Cart main content : End -->
@stop

@section('page-specific-js')
    <script>
        $(function(){
            $("#certificate_info").addClass('active');
        });
        function noTaxExemptFormAlert(){
            swal(
                    'Oops...',
                    'No tax exempt form uploaded from admin. Please Contact admin!',
                    'error'
            )
        }
    </script>
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
        </div>
    </div>
    </section>
@stop