@extends('user.template.layout')
@section('title')
    About us
@stop
@section('page-specific-css')
@stop
@section('content')
    <section class="">
        <div class="container breadcumb">
            <div class="row">
                <div class="col-sm-3 hidden-xs">
                    <h1 class="mh-title">About Us</h1>
                </div>
                <div class="breadcrumb-w col-sm-9">
                    <span class="hidden-xs">You are here:</span>
                    <ul class="breadcrumb">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li>
                            <span>About Us</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section id="aboutus" class="pr-main">
        <div class="container">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <img src="/images/print-shop-01.jpg" />
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="top"><h2 style="margin-top: 0px"><span>Welcome at DGD Print</span></h2>
                    <p>DGD Print is a premier digital printing company specialized in providing extensive range of
                        printing products ranging from business cards, postcards, flyers, brochures to stationery and other
                        premium online printing products. We serve home and businesses with our superior quality
                        products and services to create an engaging, long-term mutually beneficial relationship with our
                        clients. We strive to excel in our service delivery process to facilitate a win-win situation for the
                        parties involved.</p>
                    <p>
                        From inception to reality our work process is executed by highly professional and expert
                        individuals utilizing the most advanced technology, latest printers, quality papers and ink. We
                        always stand by our promise to deliver the best quality products at the most affordable price to
                        guarantee your satisfaction.
                    </p>
                    <p>
                        We constantly put our best efforts so that our customers get the best. We put our clients first; we
                        listen to you, understand your needs, and collaborate with you to customize service according to
                        the needs; and finally produce the supreme quality products and deliver in time. We are driven
                        by our relentless urge to provide ultimate client satisfaction.
                    </p>
                    <p>
                        Whatever your printing needs for marketing and promotional activities we offer comprehensive
                        range of digital printing and design solutions to help you communicate your visual message to
                        your target audience
                    </p>
                </div>
            </div>
            {{--<div class="col-md-12 col-sm-12 col-xs-12">--}}
                {{--<h1>Our specialization</h1>--}}
                {{--<div class="col-md-3 col-sm-3"></div>--}}
                {{--<div class="col-md-6 col-sm-6 col-xs-12" style="width: 100%">--}}
                    {{--<div class="progress">--}}
                        {{--<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 100%">--}}
                            {{--<span>Huge Quantity</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="progress">--}}
                        {{--<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 95%">--}}
                            {{--<span>On Time </span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="progress">--}}
                        {{--<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 97%">--}}
                            {{--<span>True Color</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="progress">--}}
                        {{--<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 95%">--}}
                            {{--<span>Fast Delivery </span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-3 col-sm-3"></div>--}}
            {{--</div>--}}
            {{--<div class="col-md-12 col-sm-12 col-xs-12">--}}
                {{--<h1>Quality Printing </h1>--}}
                {{--<p>High quality printing is ensured through the use of sate of the art technology combined with--}}
                    {{--finest quality printing materials.--}}
                {{--</p>--}}
                {{--<div class="col-md-4 col-sm-4 col-xs-12">--}}
                {{--<div>--}}
                {{--<img src="./images/abouts/about01.png" />--}}
                {{--<h3>Frank Furious</h3>--}}
                {{--<h4>Art Director</h4>--}}
                {{--<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. <span>Lorem ipsum dolor</span> sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. </p>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-4 col-sm-4 col-xs-12">--}}
                {{--<div>--}}
                {{--<img src="./images/abouts/about02.png" />--}}
                {{--<h3>Kara Kulis</h3>--}}
                {{--<h4>Marketing & Sales</h4>--}}
                {{--<p>--}}
                {{--Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.--}}
                {{--</p>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-4 col-sm-4 col-xs-12">--}}
                {{--<div>--}}
                {{--<img src="./images/abouts/about03.png" />--}}
                {{--<h3>Andrea Arkov</h3>--}}
                {{--<h4>Public Relations</h4>--}}
                {{--<p>--}}
                {{--Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.  </p>--}}
                {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-12 col-sm-12 col-xs-12">--}}
                {{--<h1>Timely Delivery  </h1>--}}
                {{--<p>DGD Print offers best quality products within the shortest possible time and promises timely delivery.</p>--}}
            {{--</div>--}}
            {{--<div class="col-md-12 col-sm-12 col-xs-12">--}}
                {{--<h1>Eco-Minded</h1>--}}
                {{--<p>Our eco-friendly practice using waterless technology reflects our commitment to preserve a--}}
                    {{--greener environment.--}}
                {{--</p>--}}
            {{--</div>--}}
            {{--<div class="col-md-12 col-sm-12 col-xs-12">--}}
                {{--<h1>Money Back Guaranteed  </h1>--}}
                {{--<p>We value the trust you put on us with the job and the money you invest and try to exceed your--}}
                    {{--expectations, Otherwise we refund you.--}}
                {{--</p>--}}
            {{--</div>--}}
        </div>
    </section>
    <!--Home Trust : Begin-->
    <section class=" trust-section">
        <div class="container trust-w inview">
            <div class="row">
                <div class="col-md-3 col-sm-6 block-trust trust-col-quantity ">
                    <div class="tr-icon"><i class="fa fa-thumbs-up"></i></div>
                    <div class="tr-text">
                        <h3>Quality Printing</h3>
                        <span class="tr-line"></span>
                        <p>High quality printing is ensured through the use of sate of the art technology combined with finest quality printing materials.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 block-trust trust-col-time-delivery">
                    <div class="tr-icon"><i class="fa fa-paper-plane"></i></div>
                    <div class="tr-text">
                        <h3>Timely Delivery</h3>
                        <span class="tr-line"></span>
                        <p>DGD Print offers best quality products within the shortest possible time and promises timely delivery.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 block-trust trust-col-eco-minded">
                    <div class="tr-icon"><i class="fa fa-leaf"></i></div>
                    <div class="tr-text">
                        <h3>Eco-Minded</h3>
                        <span class="tr-line"></span>
                        <p>
                            Our eco-friendly practice using waterless technology reflects our commitment to preserve a greener environment.
                        </p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 block-trust trust-col-eco-money">
                    <div class="tr-icon"><i class="fa fa-money"></i></div>
                    <div class="tr-text">
                        <h3>Money Back Guaranteed</h3>
                        <span class="tr-line"></span>
                        <p>
                            We value the trust you put on us with the job and the money you invest and try to exceed your expectations, Otherwise we refund you.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section><!--Home Trust : End-->

    <!--Home make print : Begin -->
    <section class=" home-make-print-section">
        <div class="container home-make-print">
            <div class="row">
                <div class="block-title-w">
                    <h2 class="block-title">HOW WE MAKE PRINTING AS EASY</h2>
                    <span class="icon-title">
							<span></span>
							<i class="fa fa-star"></i>
						</span>
                </div><!--make print Title : End -->
                <div class="print-content">
                    <div class="col-md-4 col-sm-4 print-block print-block-left">
                        <div class="w-print-block frist">
                            <div class="print-icon">
                                <i class="fa fa-hand-o-up"></i>
                                <i class="fa fa-newspaper-o"></i>
                            </div>
                            <div class="print-title">
                                <a href="#">Select Options</a>
                            </div>
                            <div class="print-number">
                                <span>01</span>
                            </div>
                            <div class="print-txt">
                                <p>Choose your needed options to get your desired printing jobs done like never before.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 print-block print-block-center">
                        <div class="w-print-block">
                            <div class="print-icon">
                                <i class="fa fa-file-text-o"></i>
                                <i class="fa fa-arrow-circle-o-up"></i>
                            </div>
                            <div class="print-title">
                                <a href="#">Upload your design</a>
                            </div>
                            <div class="print-number">
                                <span>02</span>
                            </div>
                            <div class="print-txt">
                                <p>Upload your finished design here and we will print it the way you want.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 print-block print-block-right">
                        <div class="w-print-block">
                            <div class="print-icon">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <div class="print-title">
                                <a href="#">Checkout & Order</a>
                            </div>
                            <div class="print-number">
                                <span>03</span>
                            </div>
                            <div class="print-txt">
                                <p>Checkout and complete your order easily and conveniently with one-step checkout extension.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg_make_print hidden-xs">

            </div>
        </div>
    </section>
    <!--Home capabilitie : Begin -->
    <section class="home-capabititie-section">
        <div class="container home-capabititie">
            <div class="row">
                <div class="block-title-w">
                    <h2 class="block-title">our capabilities</h2>
                    <span class="sub-title">We rely on our capabilities to deliver you the highest standard of quality products at the most competitive price.</span>
                    <span class="icon-title">
							<span></span>
							<i class="fa fa-star"></i>
						</span>
                </div>
                <div class="block-capabititie-w">
                    <div class="block-capabititie col-md-3 col-sm-3 col-xs-12">
                        <div class="block-mydoughnut" id="myDoughnut"> </div>
                        <h2 class="title">huge quantity</h2>
                        <div class="decs">
                            <p>We have the expertise and infrastructure and competent professionals to deliver large quantity of
                                products within expected timeframe.</p>
                        </div>
                    </div>
                    <div class="block-capabititie col-md-3 col-sm-3 col-xs-12">
                        <div class="block-mydoughnut" id="myDoughnut2"> </div>
                        <h2 class="title">on Time</h2>
                        <div class="decs">
                            <p>Our customers trust us for keeping our promise to deliver products and service on time.</p>
                        </div>
                    </div>
                    <div class="block-capabititie col-md-3 col-sm-3 col-xs-12">
                        <div class="block-mydoughnut" id="myDoughnut3"> </div>
                        <h2 class="title">True Color</h2>
                        <div class="decs">
                            <p>We use true and vibrant colors to make your message visually appealing to your audience.</p>
                        </div>
                    </div>
                    <div class="block-capabititie col-md-3 col-sm-3 col-xs-12">
                        <div class="block-mydoughnut" id="myDoughnut4"> </div>
                        <h2 class="title">fast Delivery</h2>
                        <div class="decs">
                            <p>Our fastest turnaround time is achieved by delivering fast.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
