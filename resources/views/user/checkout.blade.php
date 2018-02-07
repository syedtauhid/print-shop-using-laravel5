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
                        <h1 class="mh-title">Checkout</h1>
                    </div>
                    <div class="breadcrumb-w col-sm-9">
                        <span class="hidden-xs">You are here:</span>
                        <ul class="breadcrumb">
                            <li>
                                <a href="./index.html">Home</a>
                            </li>
                            <li>
                                <span>Checkout</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section id="checkout" class="">
            <div class="container pr-main">
<!--                 <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="cart-top">
                        <img alt="Cart top banner" src="./images/banner/cart/top-banner.jpg" />
                    </div>
                </div> -->
<!--                 <div class="cart-view-top">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <h1>Shopping Cart</h1>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 right">
                        <h1>Continue Shopping</h1>
                    </div>
                    <div id="login-pane" class="col-md-12 col-sm-12 col-xs-12">
                        <p>Please fill in the fields below to complete your order.<a id="login-modal-trigger" href="#"> Already registered? Click here to login.</a></p>
                    </div>
                </div> -->


                <div class="onepage">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div id="div_billto">
                            <div class="pane round-box">
                                <h3 class="title"><span class="icon icon-one">1</span>DELIVERY INFO</h3>
                                <div class="pane-inner">
                                    <div class="field-wrapper">

                                        <label for="pick_from" class="virtuemart_state_id">
                                            Delivery To<em>*</em>                  </label>
                                        <br />
                                        <div class="form-group">
 <label class="radio-inline"><input type="radio" value="from_ship" id="pick_from"  name="pick_from">Ship to address </label>
<label class="radio-inline"><input type="radio" value="from_store" id="pick_from"  name="pick_from">Pick from address </label>
                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Cos 1 -->


                        <div id="shipping_info_w">
                            <div id="div_shipto" class="shipping_info">
                                <div class="pane round-box">
                                    <h3 class="title">
                                        <span class="icon icon-two">2</span>
                                        SHIPMENT ADDRESS		</h3>

                                    <div id="table_shipto" class="pane-inner">
                               {!! Form::open(array('method'=>'post','route'=>['order.store'],'id'=>'shipInfoForm')) !!}
                                        <input type="hidden" id="shipping_cost" name="shipping_cost" value="0"/>
                                        <input type="hidden" id="discount" name="discount" value="no"/>
                                        <input type="hidden" id="shipment_method" name="shipment_method" value="1"/>
                                        <ul id="table_shippingto" class="adminform user-details no-border">

                                            <li class="short">
                                                <div class="field-wrapper">
                                                    <label for="shipto_first_name_field" class="shipto_first_name">
                                                        First Name<em>*</em>					</label>
                                                    <br />
                                                    <input type="text" maxlength="32" value="" size="30" name="first_name" id="shipto_first_name_field" required/>
                                                </div></li>

                                            <li class="short right">
                                                <div class="field-wrapper">
                                                    <label for="shipto_last_name_field" class="shipto_last_name">
                                                        Last Name<em>*</em>					</label>
                                                    <br />
                                                    <input type="text" maxlength="32" value="" size="30" name="last_name" id="shipto_last_name_field" required/>
                                                </div></li>

                                            <li class="long">
                                                <div class="field-wrapper">
                                                    <label for="shipto_address_1_field" class="shipto_address_1">
                                                        Address<em>*</em>					</label>
                                                    <br />
                                                    <input type="text" maxlength="64" class="required" value="" size="30" name="address" id="shipto_address_1_field" required/>
                                                </div></li>

                                            <li class="long">
                                                <div class="field-wrapper">
                                                    <label for="shipto_virtuemart_country_id_field" class="shipto_virtuemart_country_id">
                                                        Country<em>*</em>					</label>
                                                    <br />
                                                    <select style="width: 210px" class="vm-chzn-select required" name="country" id="shipto_virtuemart_country_id">
                                                        <option selected="selected" value="USA" />USA
                                                    </select>

                                                </div></li>

                                            <li class="long">
                                                <div class="field-wrapper">
                                                    <label for="shipto_virtuemart_state_id_field" class="shipto_virtuemart_state_id">
                                                        State / Province / Region<em>*</em>					</label>
                                                    <br />
                                                    <select style="width: 210px" name="state" class="vm-chzn-select" id="shipto_virtuemart_state_id" required>
                                                        <option value="" />-- Select --
                                                    </select>
                                                </div></li>
                                            <li class="long">
                                                <div class="field-wrapper">
                                                    <label for="shipto_address_1_field" class="shipto_address_1">
                                                        City<em>*</em>					</label>
                                                    <br />
                                                    <input type="text" maxlength="64" class="required" value="" size="30" name="city" required/>
                                                </div></li>
                                            <li class="long">
                                                <div class="field-wrapper">
                                                    <label for="shipto_zip_field" class="shipto_zip">
                                                        Zip / Postal Code<em>*</em>					</label>
                                                    <br />
                                                    <input type="text" maxlength="32" class="required" value="" size="30" name="zipcode" id="shipto_zip_field" required/>
                                                </div></li>
                                            <li class="long">
                                                <div class="field-wrapper">
                                                    <label for="shipto_phone_2_field" class="shipto_phone_2">
                                                        Mobile<em>*</em>					</label>
                                                    <br />
                                                    <input type="text" maxlength="32" value="" size="30" name="mobile" id="shipto_phone_2_field" required/>
                                                </div></li>
                                        </ul>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div><!-- shipping_info -->
                    </div>
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <div id="right-pane-top" class="col-md-12 col-sm-12 col-xs-12">
                            <div id="shipping_method" class="col-md-6 col-sm-12 col-xs-12">
                                <div class="shipment-pane">
                                    <div class="pane round-box">
                                        <h3 class="title">
                                            <span class="icon icon-three">3</span>
                                            Shipping method		</h3>
                                        <div class="pane-inner" style="visibility: visible;">
                                            Select shipment<fieldset id="shipments"><input type="radio" value="1" id="shipment_id_1" name="virtuemart_shipmentmethod_id" checked="checked" />
                                                <label for="shipment_id_1"><span class="vmshipment"><span class="vmshipment_name">FedEx</span></span></label>
                                                <br /></fieldset></div>
                                    </div>
                                </div>
                            </div><!-- shipping_method -->

                            <div id="payment_method" class="col-md-6 col-sm-12 col-xs-12">
                                <div class="payment-pane">
                                    <div class="pane round-box">
                                        <h3 class="title">
                                            We accept		</h3>
                                        <div class="pane-inner">
                                            <img src="./images/footer-payment.png" alt="Payment method" style="margin-bottom: 20px">
                                        </div>
                                    </div>
                                </div>
                            </div><!-- payment_method -->
                        </div>
                    </div>
                    <div id="checkfull" class="col-md-8 col-sm-12 col-xs-12">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <!-- render layout -->

                            <fieldset class="round-box" id="cart-contents">
                                <h3 class="title"><span class="icon fa fa-check"></span>ORDER REVIEWS</h3>
                                <table cellspacing="0" cellpadding="0" border="0" class="cart-summary no-border">
                                    <tbody><tr clas="top-header">
                                        <th align="left" class="th-name">Products Name</th>
                                        <th width="10%" class="th-price">Preview</th>
                                        <th width="15%" class="th-quanlity"></th>
                                        <th width="15%" align="left" class="th-total th-last">Price</th>
                                    </tr>
                                    @php($noOfProduct = 0)
                                    @foreach ($cart as $value)
                                    <tr valign="top" id="product_row_0" class="product-detail-row product-detail-last-row sectiontableentry1">
                                        <td align="left" class="pro_name">
                                            <a class="product-name" href="#" style="padding-top: 10px">{{isset($value->PROJECT_NAME) ? $value->PROJECT_NAME : "Demo"}}</a>
                                        </td>
                                        <td align="left" class="pro_name">
                                            <img class="cart-images" src="{{$value->view_image}}" />
                                        </td>
                                        <td align="left" style="padding-top: 35px" >
                                            <!-- <input type="text" id="quantity_0" readonly value="1" maxlength="4" size="3" name="quantity[0]" class="quantity-input js-recalculate" title="Update Quantity In Cart" /> -->
                                            <!-- 1 -->
                                            <span class="product-quanlity"></span>
                                        </td>

                                        <td align="right" id="subtotal_with_tax_0" colspan="0" class="sub-total td-last" style="padding-top: 35px">
                                            <span class="line-through">${{$value->total_price}}</span>
                                        </td>
                                    </tr>
                                    @php
                                        if (isset($sub_total))
                                           $sub_total += $value->total_price;
                                        else
                                           $sub_total = $value->total_price;
                                        $noOfProduct++;
                                    @endphp
                                    @endforeach
                                    <!--Begin of SubTotal, Tax, Shipment, Coupon Discount and Total listing -->
                                    <!--  Total -->
                                    <tr class="pr-total">
                                        <td colspan="6">
                                            <table>
                                                <tbody>
                                                <tr class="first">
                                                    <td>SubTotal:</td>
                                                    <td class="pr-right">
                                                        <div class="PricesalesPrice vm-display vm-price-value">
                                                            <span class="vm-price-desc"></span><span id="sub_total" class="PricesalesPrice">${{$sub_total}}</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Discount:</td>
                                                    <td class="pr-right">
                                                        <span id="discount_amount" class="priceColor2">$0.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Shipment:</td>
                                                    <td class="pr-right"><span id="shipment" class="priceColor2">$0.00</span></td>
                                                </tr>
                                                <tr class="last">
                                                    <td>Total:</td>
                                                    <td class="pr-right"><strong id="bill_total">${{$sub_total}}</strong></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <!--  End Total -->

                                    </tbody></table>
                                <p style="float: right;color: red">** Shipping cost for per item is  $15</p>
                            </fieldset>

                            <div id="right-pane-bottom">
                                <div class="customer-note">
                                    <p class="comment">Notes and special requests</p>
                                    <textarea class="inputbox" rows="1" cols="60" name="customer_note" id="customer_note_field"></textarea>
                                </div>
                                <fieldset class="vm-fieldset-tos">
                                    <input id="tos" class="terms-of-service" type="checkbox" name="tos" value="1" />
                                    <span>Click here to read terms of service and check the box to accept them.</span>
                                    <div class="checkout-button-top">
                                        <a href="#" class="vm-button-correct disabled-content" id="confirmPurchase" onclick="submitOrder()"><span>Confirm Purchase</span></a>
                                    </div>
                                </fieldset>
                            </div><!-- right-pane-bottom -->

                        </div>

                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade" id="paymentModal" role="dialog">
            <div class="modal-dialog">
                @if(isset($total_bill))
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="background: #25bce9">
                        <h3 class="title"><span class="icon icon-three">4</span>Payment</h3>
                    </div>
                    <div class="modal-body">
                        <p>To place the order you have to pay the due. Total due is: <b>${{$total_bill}}</b></p>
                        <table cellspacing="0" cellpadding="0" border="0" class="cart-summary no-border">
                            <tbody>
                            <tr clas="top-header">
                                <th align="left" class="th-name">Products Name</th>
                                <th width="10%" class="th-price">Preview</th>
                                <th width="15%" class="th-quanlity"></th>
                                <th width="15%" align="left" class="th-total th-last">Price</th>
                            </tr>
                            <!--Begin of SubTotal, Tax, Shipment, Coupon Discount and Total listing -->
                            @foreach ($cart as $value)
                                <tr valign="top" id="product_row_0" class="product-detail-row product-detail-last-row sectiontableentry1">
                                    <td align="left" class="pro_name">
                                        <a class="product-name" href="#" style="padding-top: 10px">{{isset($value->PROJECT_NAME) ? $value->PROJECT_NAME : "Demo"}}</a>
                                    </td>
                                    <td align="left" class="pro_name">
                                        <img class="cart-images" src="{{$value->view_image}}" />
                                    </td>
                                    <td align="left" style="padding-top: 35px" >
                                        <!-- <input type="text" id="quantity_0" readonly value="1" maxlength="4" size="3" name="quantity[0]" class="quantity-input js-recalculate" title="Update Quantity In Cart" /> -->
                                        <!-- 1 -->
                                        <span class="product-quanlity"></span>
                                    </td>

                                    <td align="right" id="subtotal_with_tax_0" colspan="0" class="sub-total td-last" style="padding-top: 35px">
                                        <span class="line-through">${{$value->total_price}}</span>
                                    </td>
                                </tr>
                            @endforeach
                            <!--  Total -->
                            <tr class="pr-total">
                                <td colspan="6">
                                    <table>
                                        <tbody>
                                        <tr class="first">
                                            <td>SubTotal:</td>
                                            <td class="pr-right">
                                                <div class="PricesalesPrice vm-display vm-price-value">
                                                    <span class="vm-price-desc"></span><span class="PricesalesPrice">${{$sub_total}}</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Discount:</td>
                                            <td class="pr-right">
                                                <span id="discount_amount" class="priceColor2">$0.00</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Shipment:</td>
                                            <td class="pr-right"><span class="priceColor2">${{round($total_bill - $sub_total,1)}}</span></td>
                                        </tr>
                                        <tr class="last">
                                            <td>Total:</td>
                                            <td class="pr-right"><strong>${{$total_bill}}</strong></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!--  End Total -->

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <img src="./images/footer-payment.png" alt="Payment method" style="margin-bottom: 20px;float: left;">
                        <form action="{{route('secure.payment.post.charge')}}" method="POST" style="float: right;max-width: 190px">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="amount" value="{{round($total_bill*100)}}"/>
                            <script
                                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                    data-key="pk_test_gG1tcwj8555Ml1vflNTPQD4K"
                                    data-amount="{{round($total_bill*100)}}"
                                    data-name="DGD PRINT"
                                    data-description="Payment form"
                                    data-image="/images/dgd-logo.png"
                                    data-locale="auto"
                                    data-zip-code="false"
                                    data-email="{{Auth::user()->email}}"
                                    data-billing-address="true"
                                    data-label="Proceed and Pay ${{$total_bill}}">
                            </script>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
@stop
@section('page-specific-js')
    <script>
        var NO_OF_PRODUCTS = parseInt("{{$noOfProduct}}");
        var SHOW_PAYMENT_DIALOG = "{{isset($total_bill) ? "yes" : "no"}}";
        var STATES = {
            'AL': 'Alabama',
            'AK': 'Alaska',
            'AS': 'American Samoa',
            'AZ': 'Arizona',
            'AR': 'Arkansas',
            'CA': 'California',
            'CO': 'Colorado',
            'CT': 'Connecticut',
            'DE': 'Delaware',
            'DC': 'District Of Columbia',
            'FM': 'Federated States Of Micronesia',
            'FL': 'Florida',
            'GA': 'Georgia',
            'GU': 'Guam',
            'HI': 'Hawaii',
            'ID': 'Idaho',
            'IL': 'Illinois',
            'IN': 'Indiana',
            'IA': 'Iowa',
            'KS': 'Kansas',
            'KY': 'Kentucky',
            'LA': 'Louisiana',
            'ME': 'Maine',
            'MH': 'Marshall Islands',
            'MD': 'Maryland',
            'MA': 'Massachusetts',
            'MI': 'Michigan',
            'MN': 'Minnesota',
            'MS': 'Mississippi',
            'MO': 'Missouri',
            'MT': 'Montana',
            'NE': 'Nebraska',
            'NV': 'Nevada',
            'NH': 'New Hampshire',
            'NJ': 'New Jersey',
            'NM': 'New Mexico',
            'NY': 'New York',
            'NC': 'North Carolina',
            'ND': 'North Dakota',
            'MP': 'Northern Mariana Islands',
            'OH': 'Ohio',
            'OK': 'Oklahoma',
            'OR': 'Oregon',
            'PW': 'Palau',
            'PA': 'Pennsylvania',
            'PR': 'Puerto Rico',
            'RI': 'Rhode Island',
            'SC': 'South Carolina',
            'SD': 'South Dakota',
            'TN': 'Tennessee',
            'TX': 'Texas',
            'UT': 'Utah',
            'VT': 'Vermont',
            'VI': 'Virgin Islands',
            'VA': 'Virginia',
            'WA': 'Washington',
            'WV': 'West Virginia',
            'WI': 'Wisconsin',
            'WY': 'Wyoming'
        };

        $('input[type=radio][name=pick_from]').change(function () {
            showHideShipAddress();
        });

        window.onload = function () {
            loadStatesIntoOptions();
            showHideShipAddress();
        };
        $("#tos").click(function () {
            if ($(this).is(":checked"))
                $("#confirmPurchase").removeClass("disabled-content");
            else
                $("#confirmPurchase").addClass("disabled-content");
        });
        $(document).ready(function(){
            if (SHOW_PAYMENT_DIALOG == "yes")
                $("#paymentModal").modal({backdrop: "static"});
        });

        function setModalMaxHeight(element) {
            this.$element     = $(element);
            this.$content     = this.$element.find('.modal-content');
            var borderWidth   = this.$content.outerHeight() - this.$content.innerHeight();
            var dialogMargin  = $(window).width() < 768 ? 20 : 60;
            var contentHeight = $(window).height() - (dialogMargin + borderWidth);
            var headerHeight  = this.$element.find('.modal-header').outerHeight() || 0;
            var footerHeight  = this.$element.find('.modal-footer').outerHeight() || 0;
            var maxHeight     = contentHeight - (headerHeight + footerHeight);

            this.$content.css({
                'overflow': 'hidden'
            });

            this.$element
                .find('.modal-body').css({
                'max-height': maxHeight,
                'overflow-y': 'auto'
            });
        }

        $('.paymentModal').on('show.bs.modal', function() {
            $(this).show();
            setModalMaxHeight(this);
        });

        $(window).resize(function() {
            if ($('.modal.in').length) {
                setModalMaxHeight($('.modal.in'));
            }
        });
    </script>
@stop
