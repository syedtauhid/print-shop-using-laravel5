@extends('user.template.layout')
@section('title')
    Home
@stop
@section('page-specific-css')
    <style>
        .form-group{
            margin: 0 !important;
        }
        .pr-login{
            padding: 30px;
            background-color: #fcfcfc;
        }
    </style>
@stop
@section('content')

    <section class="">
        <div class="container breadcumb">
            <div class="row">
                <div class="col-sm-3 hidden-xs">
                    <h1 class="mh-title">Register</h1>
                </div>
                <div class="breadcrumb-w col-sm-9">
                    <span class="hidden-xs">You are here:</span>
                    <ul class="breadcrumb">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li>
                            <span>Register</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="" id="pr-register">
        <div class="container pr-login">
            <div class="row login-row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 left">
                        <h4>Create an Account</h4>
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <p>Name <span class="star">*</span></p>
                                <input class="firstname" type="text" name="name" value="{{ old('name') }}" required autofocus/>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <p>Email Address <span class="star">*</span></p>
                                <input class="email" type="email" name="email" value="{{ old('email') }}" required />

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <p>Create a password  <span class="star">*</span></p>
                                <input class="pasword" type="password"  name="password" required />

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <p>confirm a password  <span class="star">*</span></p>
                                <input class="re-pasword" type="password" name="password_confirmation" required />
                            </div>
                        <div>
                            <br />
                            <button type="submit" class="btn btn-success">Register</button><span style="margin-left: 10px;"><a href="{{route('login')}}">Login Now</a></span>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
