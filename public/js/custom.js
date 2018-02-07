/*
* Create by Tauhid
* Description: custom functions used for this project
* */

//Show hide shiping address based on delivery info
function showHideShipAddress() {
    var deliveryType = $('input[type=radio][name="pick_from"]:checked').val();
    console.log(deliveryType);
    if (deliveryType == "from_store"){
        $("#shipping_method").addClass("disabled-content");
        $("#shipment_method").val(0);
        $("#shipment").html("$" + 0);
    }
    else {
        $("#shipping_method").removeClass("disabled-content");
        $("#shipment_method").val(1);
        $("#shipment").html("$" + (NO_OF_PRODUCTS * 15));
    }
    var sub = $("#sub_total").html();
    var dis = $("#discount_amount").html();
    var ship = $("#shipment").html();
    //var total = $("#bill_total").html();
    sub = parseFloat(sub.replace("$",""));
    dis = parseFloat(dis.replace("$",""));
    ship = parseFloat(ship.replace("$",""));
    var total = sub + ship - dis;
    $("#bill_total").html("$" + total);
}

//Submit the checkout form
function submitOrder() {
    if (validateForm($("#shipInfoForm :input[required]"))) {
        waitingDialog.show("Checking order");
        $("#shipInfoForm").submit();
        //$("#paymentModal").modal({backdrop: "static"});
    }
}

//Load Staes into options
function loadStatesIntoOptions() {
    for (var key in STATES) {
        $('#shipto_virtuemart_state_id').append($('<option>', {
            value: STATES[key],
            text: STATES[key]
        }));
    }
}

//Open the image upload box
function openChoseDialog(id) {
    try {
        $("#file_" + id).click();
    } catch (e)
    {
        console.log(e);
    }
}

function updateCartItemFromNavBer(isAdded, item) {
    if (isAdded){
        addItemToNavbarCart(item);
    } else {
        removeCartItemFromNavbar(item);
    }
    $(".mcart-dd-qty").html(TOTAL_ITEM_IN_CART);
}

function removeCartItemFromNavbar(item) {
    --TOTAL_ITEM_IN_CART;
    $("#item_" + item).hide();
    $("#navCartTotalPrice").html("$" + TOTAL_PRICE);
}

function addItemToNavbarCart(item) {
    ++TOTAL_ITEM_IN_CART;
    TOTAL_PRICE__OF_ITEMS_IN_CART += parseFloat(item.price);

    var html ='<div class="mcart-item-w clearfix1" id="item_'+TOTAL_ITEM_IN_CART+'">'
        +'<ul> <li class="mcart-item"> <img src="'+item.image+'" alt="postcard cards" style="height: 50px;width:70px"/>'
        +'<div class="mcart-info">'
        + '<a href="#" class="mcart-name">'+item.name+'</a>'
        + '<span class="mcart-price">$'+item.price+'</span>'
        + '<span class="mcart-remove-item">'
        + '<i class="fa fa-times-circle"></i>'
        + '</span> </div> </li> </ul> </div>';
    $("#cartItemContainer").prepend(html);
    $("#navCartTotalPrice").html("$" + TOTAL_PRICE__OF_ITEMS_IN_CART);
    $("#navCartFooter").show();
    $(".mcart-noitems").hide();
}

function removeItemFromCart(url,completed) {
    console.log(url);
    $.ajax({
        type: "GET",
        url: url,
        // success: function(data)
        // {
        //     completed(data);
        // },
        complete: function (data) {
            console.log(data);
            completed(data);
            try {
                var item = url.split("/");
                updateCartItemFromNavBer(false,item[item.length - 1]);
            } catch (e){}
        }
    });
}

//Show the currently uploaded image
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var id = $(input).attr('data-id');
        console.log("readUrl.." + id);
        reader.onload = function (e) {
            var image = '<img src="' + e.target.result + '" style="height: 180px; width: 150px; margin: auto" />';
            $("#image_placeholder_" + id).html(image);
            // $('#blah').attr('src', e.target.result)
            //     .width(150)
            //     .height(200);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

//Calculate the oreder price
function calculatePrice() {
    var rootValue,values = [], price;
    try {
        for (var id in DEPENDENCY_JSON){
            var name = DEPENDENCY_JSON[id];
            var val = $("#" + name).val();
            if (name == BASE_DEPENDENCY)
                rootValue = val ? parseFloat(val) : 0;
            else
                values[name] = val;
        }
    } catch(e){
    }

    if (rootValue){
        for (var i = 0; i < PRICE_JSON.length; i++){
            price = parseFloat(PRICE_JSON[i]["price"]);
            if (rootValue <= parseFloat(PRICE_JSON[i][BASE_DEPENDENCY]) && isValueCorrect(PRICE_JSON[i],values))
                break;
        }
    } else {
        price = 0;
    }
    price = rootValue * price;
    price = parseFloat(price.toFixed(2));
    $("#core_price").html("Price : $" + price);
    $("#net_price").html("Total : $" + applyTAX(price));
    $("#total-price").val(applyTAX(price));
    $("#price").val(price);
    $("#tax").val(calculateTax(price));
}

//Is the price fix in the current array
function isValueCorrect(obj, arr) {
    for(var key in obj ){
        if (key == BASE_DEPENDENCY || key == "price")
            continue;
        console.log(obj[key] + "::" + arr[key])
        if (obj[key] != arr[key])
        {
            return false;
        }
    }
    return true;
}

//Apply Tax on price
function applyTAX(price) {
    return (calculateTax(price) + price).toFixed(2);
}

function calculateTax(price) {
    return (price*TAX_PERCENT)/100;
}

//return true if null or undefined
function isUndefinedOrNull(obj) {
    return undefined === obj || null == obj;
}

//check the required field of form
function validateForm($inputs) {
    var isValid = true;
    $inputs.each(function() {
      var value = $(this).val();
      if ("" == value) {
          console.log(value);
        $(this).focus();
        $(this).parent().addClass("has-error");
        isValid = false;
        return false;
      }
    });
    return isValid;
}

//method for add to cart
function addToCart() {
    var item = [];
    var form = $("#pressInfoForm");
  $.ajax({
      type: "POST",
      data: form.serialize(),
      url: ADD_TO_CART_URL,
      success: function(data)
      {
          $('#add-to-cart').text("Added to cart");
          $("#pressInfoForm").attr("action",CHECKOUT_URL);
          item.image = form.find('input[name="view_image"]').val();
          item.price = form.find('input[name="total_price"]').val();
          item.name = form.find('input[name="PROJECT_NAME"]').val();
          updateCartItemFromNavBer(true,item);
          swal("Successfully Added!!","", "success");
      }
  });
}

window.onload = function () {
  $(".hidden_file_input").change(function(){
      readURL(this);
  });
};


  $("#add-to-cart").click(function () {
      if (validateForm($("#pressInfoForm :input[required]"))) {
        addToCart();
      }
  });
  $("#proceed-to-checkout").click(function () {
      if (validateForm($("#pressInfoForm :input[required]"))) {
          $("#pressInfoForm").submit();
      }
  });


//Loading Modals
var waitingDialog = waitingDialog || (function ($) {
    'use strict';

	// Creating modal dialog's DOM
	var $dialog = $(
		'<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">' +
		'<div class="modal-dialog modal-m">' +
		'<div class="modal-content">' +
			'<div class="modal-header"><h4 style="margin:0;color: black"></h4></div>' +
			'<div class="modal-body">' +
				'<div class="progress progress-striped active" style="margin-bottom:0;"><div class="progress-bar" style="width: 100%"></div></div>' +
			'</div>' +
		'</div></div></div>');

	return {
		/**
		 * Opens our dialog
		 * @param message Custom message
		 * @param options Custom options:
		 * 				  options.dialogSize - bootstrap postfix for dialog size, e.g. "sm", "m";
		 * 				  options.progressType - bootstrap postfix for progress bar type, e.g. "success", "warning".
		 */
		show: function (message, options) {
			// Assigning defaults
			if (typeof options === 'undefined') {
				options = {};
			}
			if (typeof message === 'undefined') {
				message = 'Loading';
			}
			var settings = $.extend({
				dialogSize: 'm',
				progressType: '',
				onHide: null // This callback runs after the dialog was hidden
			}, options);

			// Configuring dialog
			$dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
			$dialog.find('.progress-bar').attr('class', 'progress-bar');
			if (settings.progressType) {
				$dialog.find('.progress-bar').addClass('progress-bar-' + settings.progressType);
			}
			$dialog.find('h4').text(message);
			// Adding callbacks
			if (typeof settings.onHide === 'function') {
				$dialog.off('hidden.bs.modal').on('hidden.bs.modal', function (e) {
					settings.onHide.call($dialog);
				});
			}
			// Opening dialog
			$dialog.modal();
		},
		/**
		 * Closes dialog
		 */
		hide: function () {
			$dialog.modal('hide');
		}
	};

})(jQuery);
