@extends('user.template.layout')
@section('title')
Home
@stop
@section('page-specific-css')
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
                            <span>My Account</span>
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
            <div class="row acc-dashboard">
                <!--Account Sidebar: End-->
                @include('user._partial.user-nav')
                <!--Account Sidebar: End-->
                <!--Account main content : Begin -->
                <section class="account-main col-md-9 col-sm-8 col-xs-12">
                    <h3 class="acc-title lg">Edit Account Information</h3>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>{{ session('status') }}</strong>
                        </div>
                    @endif
                    <div class="form-edit-info">
                        <h4 class="acc-sub-title">Account Information</h4>
                        {!! Form::open(array('method'=>'post','route'=>'user.info','files'=>'true','name'=>'edit-acc-info')) !!}
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="first-name">First Name</label>
                                    <input type="text" class="form-control" name="first_name" id="first-name" value="{{$userDetails->userInfo?$userDetails->userInfo->first_name:''}}" />
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Address<span class="required">*</span></label>
                                    <input type="text" class="form-control" name="email" id="email" value="{{$userDetails->email}}" readonly="readonly"/>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{$userDetails->userInfo?$userDetails->userInfo->address:''}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" id="state" name="state" value="{{$userDetails->userInfo?$userDetails->userInfo->state:''}}" />
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{$userDetails->userInfo?$userDetails->userInfo->phone:''}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="company-website">Company Website</label>
                                    <input type="text" class="form-control" id="company-website" name="company_website" value="{{$userDetails->userInfo?$userDetails->userInfo->company_website:''}}" />
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="last-name">Last Name</label>
                                    <input type="text" class="form-control" id="last-name" name="last_name" value="{{$userDetails->userInfo?$userDetails->userInfo->last_name:''}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="company">Company</label>
                                    <input type="text" class="form-control" id="company" name="company" value="{{$userDetails->userInfo?$userDetails->userInfo->company:''}}" />
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="city" name="city" value="{{$userDetails->userInfo?$userDetails->userInfo->city:''}}"  />
                                </div>
                                <div class="form-group">
                                    <label for="zip">Zip</label>
                                    <input type="text" class="form-control" id="zip" name="zip" value="{{$userDetails->userInfo?$userDetails->userInfo->zip:''}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="fax">Fax</label>
                                    <input type="text" class="form-control" id="fax" name="fax" value="{{$userDetails->userInfo?$userDetails->userInfo->fax:''}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="company_code">Company Code</label>
                                    <input type="text" class="form-control" id="company_code" name="company_code" value="{{$userDetails->userInfo?$userDetails->userInfo->company_code:''}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="account-bottom-action">
                            <button type="submit" class="gbtn btn-edit-acc-info">Save</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </section><!-- Cart main content : End -->
            </div>
        </div>
    </section>

@stop
@section('page-specific-js')
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 4000);

        $(function(){
            $("#profile_info").addClass('active');
        });

    </script>
@stop
