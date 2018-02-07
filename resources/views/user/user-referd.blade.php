@extends('user.template.layout')
@section('title')
    Home
@stop
@section('page-specific-css')
    <style>
        #aboutbottom{
            padding-top: 0;
            border-top: 0;
            box-shadow: none;
            margin-bottom: 10px;
        }
        #aboutbottom .col-md-6 img{
            margin-right: 10px;
        }
        #aboutbottom .col-md-6 .data{
            float: none;
            margin-top: -10px;
        }
    </style>
@stop
@section('content')
    <section >
        <div class="container breadcumb">
            <div class="row">
                <div class="col-sm-3 hidden-xs">
                    <h1 class="mh-title">Friend Referral</h1>
                </div>
                <div class="breadcrumb-w col-sm-9">
                    <span class="hidden-xs">You are here:</span>
                    <ul class="breadcrumb">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li>
                            <span>Friend Referral</span>
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
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> {{session()->pull('success')}}.
                        </div>
                    @endif
                </div>
            </div>
            <div class="row acc-order">
                <!--Account Sidebar: End-->
                @include('user._partial.user-nav')
                <!--Account Sidebar: End-->
                <!--Account main content : Begin -->
                <section id="aboutbottom" class="account-main col-md-9 col-sm-8 col-xs-12">
                    <h3 class="acc-title lg">Referral Program</h3>
                    <div class="form-edit-info">
                        <h3> Refer a friend and Save $</h3>
                        <p>The best compliment you can give us for a job well done, is a referral.Use the form below to tell an associate about us.</p>
                    </div>
                    <div class="row">
                        <h3 class="text-center">You got referal discount from them</h3>
                        <span class="line"></span>
                        <div class="col-md-6 col-sm-6 col-xs-12 iteamleft top">
                            <img src="/images/abouts/about04.png">
                            <div class="data">
                                <p class="title">Martha M. Masters</p>
                                <p class="end">Discount Coupon<span> Martha-20-2221</span></p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 iteamright top">
                            <img src="/images/abouts/about05.png">
                            <div class="data">
                                <p class="title">Anna Vandana</p>
                                <p class="end">Discount Coupon<span> Anna-20-2221</span></p>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 iteamright">
                            <img src="/images/abouts/about08.png">
                            <div class="data">
                                <p class="title">Dr. Dosist</p>
                                <p class="end">Discount Coupon<span> Dosist-20-2221</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <fieldset>
                                <legend>Refer a friend now</legend>
                                {!! Form::open(array('method'=>'post','route'=>'user.user-referd','files'=>'true','id'=>'user_refer_form')) !!}
                                <div class="row">
                                    <div class="col-md-8 col-xs-12">
                                            <div class="form-group col-md-12 col-xs-12">
                                                <div class="col-md-2 col-xs-2">
                                                    <label for="name">Name</label>
                                                </div>
                                                <div class="col-md-10 col-xs-10">
                                                    <input type="text" class="form-control" id="name" name="refered_name" required>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 col-xs-12 @if ($errors->has('email')) has-error @endif">
                                                <div class="col-md-2 col-xs-2">
                                                    <label for="email">Email</label>
                                                </div>
                                                <div class="col-md-10 col-xs-10">
                                                    <input type="email" name="email" class="form-control" id="email" required>
                                                    @if ($errors->has('email')) <p class="help-block">This email has already invited!</p> @endif
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 col-xs-12">
                                                <div class="col-md-2 col-xs-2">
                                                    <label for="message">Message</label>
                                                </div>
                                                <div class="col-md-10 col-xs-10">
                                                    <textarea class="form-control" name="message" id="message" placeholder="Write something"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-xs-offset-4 col-xs-8">
                                                    <button type="submit" class="btn btn-primary">SEND</button>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </fieldset>
                        </div>
                    </div>
                </section><!-- Cart main content : End -->

            </div>

        </div>
    </section>
@stop
@section('page-specific-js')
    <script>
        $(function(){
            $("#refer_friend").addClass('active');
        });
    </script>
@stop
