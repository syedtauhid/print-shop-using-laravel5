@extends('user.template.layout')
@section('title')
    Home
@stop
@section('page-specific-css')
    <style>
        #remember{
            width: 12px;
            height:12px;
            margin-right: 5px;
        }
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
                    <h1 class="mh-title">Login</h1>
                </div>
                <div class="breadcrumb-w col-sm-9">
                    <span class="hidden-xs">You are here:</span>
                    <ul class="breadcrumb">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li>
                            <span>Login</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section >
        <div class="container pr-login">
            <div class="row login-row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-6 col-md-offset-3 col-sm-6 col-xs-12">
                        <h4>Login</h4>
                        <p>If you have an account with us, please log in.</p>
                        <form id="login-form" class="form-validate form-horizontal" role="form" method="POST" action="{{ url('/login') }}" >
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <p>Email Address <span class="star">*</span></p>
                                <input class="email" type="email" name="email" value="{{ old('email') }}" required autofocus />

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <p>Password <span class="star">*</span></p>
                                <input class="pasword" type="password"  name="password" required />

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div>
                                <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : ''}}  /><span class="re">Remember Me</span>
                            </div>
                            <button type="submit" class=" btn btn-success">Login</button><span style="margin-left: 10px;"><a href="{{route('register')}}">Register Here</a></span>
                        </form>
                    </div>

                    <!-- <div class="col-md-6 col-sm-6 col-xs-12 right">
                    <h4>Forgotten Password</h4>
                        <p>Fill our your email address bellow and we’ll email it to you right away!</p>
                        <form id="forgotpass-form" class="form-validate form-horizontal" method="post" action="#" />
                            <p>Email Address <span class="star">*</span></p>
                            <input class="email" type="text" value="" />

                            <button type="submit" class="ressetpass">Retrieve Password</button>
                        </form>
                    </div> -->
                </div>
            </div>
        </div>
    </section>
@endsection
