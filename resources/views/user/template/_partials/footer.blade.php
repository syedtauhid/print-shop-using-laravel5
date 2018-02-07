<!--Footer : Begin-->
<footer>
    <div class="">
        <div class="container footer-main">
            <div class="row">
                <div class="col-md-3 col-sm-4 col-xs-12 about-us footer-col">
                    <h2>About Us</h2>
                    <div class="footer-content">
                        <a href="./index.html" title="Cmsmart logo footer" class="logo-footer">
                            <img src="{{asset('images/dgd-footer.png')}}" alt="logo footer" />
                        </a>
                        <ul class="info">
                            <li>
                                <i class="fa fa-home"></i>
                                <span>37-66 72th Street Jackson Heights NY 11372</span>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i>
                                <span>+6466415348</span>
                            </li>
                            <li>
                                <i class="fa fa-envelope-o"></i>
                                <span><a href="mailto:support@netbaseteam.net" title="send mail to Cmsmart">office.digitalgraphic@gmail.com</a></span>
                            </li>
                        </ul>
                        <ul class="footer-social">
                            <li>
                                <a href="#" title="Facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="Twiter">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="Google plus">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-12 corporate footer-col">
                    <h2>Corporate</h2>
                    <div class="footer-content">
                        <ul>
                            <li>
                                <a href="/about" title="About us">About</a>
                            </li>
                            <li>
                                <a href="/about" title="Green">Green</a>
                            </li>
                            <li>
                                <a href="/about" title="Afiliates">Afiliates</a>
                            </li>
                            <li>
                                <a href="/contact" title="Non-profits and Government">Non-profits and Government</a>
                            </li>
                            <li>
                                <a href="/about" title="Terms of Service">Terms of Service</a>
                            </li>
                            <li>
                                <a href="/about" title="Privacy Policy">Privacy Policy</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-12 support footer-col">
                    <h2>Support</h2>
                    <div class="footer-content">
                        <ul>
                            <li>
                                <a href="/user/info" title="My Account">My Account</a>
                            </li>
                            <li>
                                <a href="#" title="Design Service">Design Services</a>
                            </li>
                            <li>
                                <a href="/contact" title="Contact Us">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12 other-info footer-col hidden-sm">
                    <h2>Other Info</h2>
                    <div class="footer-content">
                        <p>
                            DGD Print provides fast online printing for both homes and businesses. We  provide high quality business cards, postcards, flyers, brochures, stationery and  other premium online print products.
                        </p>
                        <img src="{{asset('images/footer-payment.png')}}" alt="Payment method" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=" ">
        <div class="container footer-bottom">
            <div class="row">
                <div class="col-md-12">
                    <p class="copy-right">DGD - Copyright © 2017 <a title="Digital Graphic Design" href="#">dgdprint.com</a>. All Rights Reserved</p>
                    <a href="#" id="back-to-top">
                        <i class="fa fa-chevron-up"></i>
                        Top
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>




<div id="sitebodyoverlay"></div>
	<nav id="mb-main-menu" class="main-menu">
		<div class="mb-menu-title">
			<h3>Navigation</h3>
			<span id="close-mb-menu">
				<i class="fa fa-times-circle"></i>
			</span>
		</div>
		<ul class="cate_list">
			<li class="level0 parent col1 all-product">
				<a href="#">
					<span>All Product</span>
					<i class="fa fa-chevron-down"></i><i class="fa fa-chevron-right"></i>
				</a>
				<ul class="level0">
                    @if(!empty($categoryTree))
                        @foreach($categoryTree as $item)
                            <li class="level1">
                                <a href="{{route('subcategory',$item->id)}}" title="{{$item->name}}">{{$item->name}}</a>
                                {{--@php--}}
                                    {{--if($item->name=='Business Cards' || $item->name=='business cards')--}}
                                        {{--$businessCard = $item;--}}

                                {{--@endphp--}}
                            </li>
                        @endforeach
                    @endif
				</ul>
			</li>
            @if(isset($businessCard))
			<li class="level0 parent col1">
				<a href="{{(count($businessCard->children)>0) ? route('subcategory',$businessCard->id) : route('category.template',$businessCard->id)}}" title="Business Cards">
					<span>Business Cards</span>
					<i class="fa fa-chevron-down"></i><i class="fa fa-chevron-right"></i>
				</a>
				<ul class="level0">
                            @if(count($businessCard->children)>0)
                                    @foreach($businessCard->children as $bacca)
                                        <li class="level1 nav-1-1 first item">
                                            <a href="#" title="{{$bacca->name}}">{{$bacca->name}}</a>
                                        </li>
                                    @endforeach
                            @endif
				</ul>
			</li>
            @endif
			<li class="level0">
                <a href="/contact">Contact</a>
			</li>
			<li class="level0">
                <a href="/about">About Us</a>
			</li>
		</ul>
	</nav> 
