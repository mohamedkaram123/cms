<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ static_asset('assets/css/tabpay.css') }}">
	<link rel="stylesheet" href="{{ static_asset('assets/css/vendors.css') }}">

    <title>{{ translate("tap payment") }}</title>
</head>
<body>
    {{-- {{ dd($orders) }} --}}
    <div class="container " style="margin-top: 40px;">

        <div  class="row  justify-content-center align-items-center" style="margin-bottom: 5%">
            <img src="{{ static_asset('assets/img/cards/Tap_Payments.png') }}" style="width: 75px;height: 150px;" />
        </div>
        <div  class="row  justify-content-center align-items-center">

            <div class="col-sm-6">
                <div class="card">

                    <div class="card-body">
                        <form id="form-container"  method="post" action="/charge">
                            <!-- Tap element will be here -->
                            <div id="element-container"></div>
                            <div id="error-handler" role="alert"></div>
                            <div id="success" style=" display: none;;position: relative;float: left;">
                                 {{ translate("Success! Your token is")}}  <span id="token"></span>
                            </div>
                            <!-- Tap pay button -->
                            <button id="tap-btn">{{ translate("Submit") }}</button>
                        </form>

                    </div>

                    <div  class="card-footer">

                        <span style="font-size: 20px;font-weight: bold;">{{ translate("Amount")}} : {{ $status == "order"? round($grand_total):$amount }}</span>

                        <span  style="font-size: 18px;font-weight: bold">{{$currency_code}}</span>
                    </div>


                </div>

            </div>

        </div>


    </div>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.3.4/bluebird.min.js"></script>
      <script src="https://secure.gosell.io/js/sdk/tap.min.js"></script>
      <script src="{{ static_asset('assets/js/vendors.js') }}" ></script>

      <script>
//pass your public key from tap's dashboard
//var tap = Tapjsli('pk_test_2cW4BJzdmLKYpQOlwH6CM0nI');
var tap = Tapjsli("{{get_setting("TapPayment_Publishable_Key")}}");

var elements = tap.elements({});
var style = {
  base: {
    color: '#535353',
    lineHeight: '18px',
    fontFamily: 'sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: 'rgba(0, 0, 0, 0.26)',
      fontSize:'15px'
    }
  },
  invalid: {
    color: 'red'
  }
};
// input labels/placeholders
var labels = {
    cardNumber:"Card Number",
    expirationDate:"MM/YY",
    cvv:"CVV",
    cardHolder:"Card Holder Name"
  };
//payment options
var paymentOptions = {
  currencyCode:["SAR"],
  labels : labels,
  TextDirection:'ltr'
}
//create element, pass style and payment options
var card = elements.create('card', {style: style},paymentOptions);
//mount element
card.mount('#element-container');
//card change event listener
card.addEventListener('change', function(event) {
  if(event.BIN){
    console.log(event.BIN)
  }
  if(event.loaded){
    console.log("UI loaded :"+event.loaded);
    console.log("current currency is :"+card.getCurrency())
  }
  var displayError = document.getElementById('error-handler');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission
var form = document.getElementById('form-container');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  tap.createToken(card).then(function(result) {
    console.log(result);
    if (result.error) {
      // Inform the user if there was an error
      var errorElement = document.getElementById('error-handler');
      errorElement.textContent = result.error.message;

              $("#tap-btn").html("{{ translate("Submit") }}");
                        $("#tap-btn").removeAttr("disabled");

    } else {



$(this).attr("disabled", true);


            var url = "{{route("auth_tappayment",[":source_id"])}}"
            url = url.replace(':source_id', result.id);


  $.ajax({
      type: "get",
      url,
      success: function (response) {
// console.log(response);

           location.href = response.url;

      },
      error:function(err){
                        $("#tap-btn").html("{{ translate("Submit") }}");
                        $("#tap-btn").removeAttr("disabled");


      }
  });

          // location.href = url;
     //   console.log(url);
     // Send the token to your server
    //   var errorElement = document.getElementById('success');
    //   errorElement.style.display = "block";
    //   var tokenElement = document.getElementById('token');
    //   tokenElement.textContent = result.id;
    //   console.log(result.id);
    }
  });
});


$(document).ready(function () {


console.log("dsds");
    $("#tap-btn").click(function (e) {
        // e.preventDefault();
        $(this).html('<img src="{{static_asset('assets/img/loading.gif') }}" style="width:25px;height:25px" />');

    });

});
      </script>
</body>
</html>
