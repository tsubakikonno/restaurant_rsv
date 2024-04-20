<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/authentication.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div class="payment">
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<form id="payment-form" action="{{ route('paymentstore') }}" method="POST" >
    @csrf
    <input type="number" id="custom-amount" name="amount" placeholder="金額を入力" class="paymentform"><br>
    <button id="custom-amount-button" type="submit" class="paymentbtn">Pay</button>
</form>
<a href="{{ route('index') }}" >戻る</a>
<script src="https://checkout.stripe.com/checkout.js"></script>
<script>
    document.getElementById('payment-form').addEventListener('submit', function(event) {
        event.preventDefault();
        var amount = document.getElementById('custom-amount').value;
        var handler = StripeCheckout.configure({
            key: '{{ env('STRIPE_KEY') }}',
            locale: 'auto',
            currency: 'JPY',
            token: function(token) {
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);
                form.submit();
            }
        });
        handler.open({
            name: 'Stripe決済デモ',
            description: 'これはデモ決済です',
            amount: amount * 1, // フォームからの入力金額をセントに変換
            image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
        });
    });
</script>
</div>
</body>
</html>