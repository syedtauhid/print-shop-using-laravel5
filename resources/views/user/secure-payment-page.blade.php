<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
    <link href="{{asset('css/payment-page.css')}}" rel="stylesheet"/>
</head>
<body>
<form>
    <div class="group">
        <label>
            <span>Name</span>
            <input name="cardholder-name" class="field" placeholder="Jane Doe" />
        </label>
        <label>
            <span>Phone</span>
            <input class="field" placeholder="(123) 456-7890" type="tel" />
        </label>
    </div>
    <div class="group">
        <label>
            <span>Card</span>
            <div id="card-element" class="field"></div>
        </label>
    </div>
    <button type="submit">Pay ${{$ammount}}</button>
    <div class="outcome">
        <div class="error"></div>
        <div class="success">
            Success<span class="token"></span>
        </div>
    </div>
</form>
</body>

<script type="text/javascript" src="{{asset('js/payment-page.js')}}"></script>

</html>