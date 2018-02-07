@extends('user.template.payment-page-container-layout')
@section('title')
    Payment
@stop
@section('page-specific-css')
@stop
@section('content')
    <section class="">
        <div class="container breadcumb">
            <div class="row">

            </div>
        </div>
    </section>
    <section >
        <div class="container pr-login">
            <iframe  src="{{route('secure.payment.page')}}" width="100%" height="300px" scrolling="no"></iframe>
        </div>
    </section>
@endsection
