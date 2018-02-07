{{--{{dd($categoryTree->toArray())}}--}}
<!--Header: Begin-->
<header>
    <!--Top Header: Begin-->
    <section id="" class="clearfix">
        <div class="container top-header">
            <div class="row">
                <div class="top-links col-lg-7 col-md-6 col-sm-5 col-xs-6">
                    <ul>
                        <li class="hidden-xs">
                            <a href="#">
                                <i class="fa fa-facebook"></i>
                                <!-- Connect with facebook -->
                            </a>
                        </li>
                        <li class="hidden-xs">
                            <a href="#">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li class="hidden-xs">
                            <a href="#">
                                <i class="fa fa-pinterest"></i>
                            </a>
                        </li>
                        <li class="hidden-xs">
                            <a href="#">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="top-header-right f-right col-lg-5 col-md-6 col-sm-7 col-xs-6">
                    <div class="w-header-right">
                        <div class="block-currency">
                            <div class="currency-active">
        									<span class="currency-name">
        										currency:<span> usd</span><i class="fa fa-angle-down"></i>
        									</span>
                            </div>
                        </div>
                        <div class="language-w clearfix">
                            <div class="language-active">
                                <span class="language-name">Language: <span>English</span><i class="fa fa-angle-down"></i></span>
                            </div>
                        </div>
                    <!-- <div class="th-hotline">
                            <i class="fa fa-envelope-o"></i>
                            <span>dgd@dgd.com</span>
                        </div> -->
                        <div class="th-hotline">
                            <i class="fa fa-phone"></i>
                            <span>1.866.614.8002</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--Top Header: End-->
    <!--Main Header: Begin-->
    <section class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 w-logo">
                    <div class="logo hd-pd ">
                        <a href="/">
                            <img src="/images/dgd-logo.png" alt="printshop logo" />
                        </a>
                    </div>
                </div>

                @php
                    $cartItems = session()->has('cart') ? json_decode(session()->get('cart')) : [];
                    //dd($cartItems);
                @endphp
                <div class="col-lg-1 col-md-2 col-sm-2 col-xs-3 headerCS">
                    <div class="cart-w SC-w hd-pd ">
							<span class="mcart-icon dropdowSCIcon">
								<i class="fa fa-shopping-cart"></i>
								<span class="mcart-dd-qty">{{sizeof($cartItems)}}</span>
							</span>
                        <div class="mcart-dd-content dropdowSCContent clearfix" id="cartItemContainer">
                            @php($counter = 0)
                            @foreach($cartItems as $value)
                                <div class="mcart-item-w clearfix1" id="{{"item_".$counter}}">
                                    <ul>
                                        <li class="mcart-item">
                                            <img src="{{$value->view_image}}" alt="postcard cards" style="height: 50px;width:70px"/>
                                            <div class="mcart-info">
                                                <a href="#" class="mcart-name">{{$value->PROJECT_NAME}}</a>
                                                <span class="mcart-price">${{$value->total_price}}</span>
                                                <span class="mcart-remove-item">
													<i class="fa fa-times-circle"></i>
												</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                @php
                                $counter++;
                                    if (isset($sub_totals))
                                       $sub_totals += $value->total_price;
                                    else
                                       $sub_totals = $value->total_price;
                                @endphp
                            @endforeach
                            @if(sizeof($cartItems) > 0)
                                <div id="navCartFooter">
                                    <div class="mcart-total clearfix">
                                        <table>
                                            <tr class="total">
                                                <td>Total</td>
                                                <td id="navCartTotalPrice">${{isset($sub_totals) ? $sub_totals : 0}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="mcart-links buttons-set clearfix">
                                        <a href="{{route('view.cart')}}" class="gbtn mcart-link-cart">View Cart</a>
                                        <a href="{{route('checkout')}}" class="gbtn mcart-link-checkout">Checkout</a>
                                    </div>
                                </div>
                            @else
                                <div class="mcart-noitems clearfix" style="text-align: center">
                                    <h4>No Items</h4>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if(Auth::user())
                        <div class="search-w SC-w hd-pd ">
							<span class="search-icon dropdowSCIcon">
                                <i class="fa fa-user"><span class="caret"></span></i>
							</span>
                            <div class="search-safari profile-parent" >
                                <div class="search-form dropdowSCContent profile-child">
                                    <div>
                                        <a href="{{route('user.info')}}">Profile</a>
                                    </div>
                                    <br>
                                    <div>
                                        <a href="{{route('logout')}}">Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="search-w SC-w hd-pd ">
							<span class="search-icon dropdowSCIcon">
								<a class="btn btn-info btn-xs" href="{{route('login')}}">Login</a>
							</span>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section><!--Main Header: End-->
    <script>
        var TOTAL_ITEM_IN_CART = {{$counter}};
        var TOTAL_PRICE__OF_ITEMS_IN_CART = {{isset($sub_totals) ? $sub_totals : 0}};
    </script>
</header><!--Header: End-->
