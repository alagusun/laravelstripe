<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 		
        <!-- Styles -->
        <link href="{{ asset('css/checkout.css') }}" rel="stylesheet">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
				width:45%;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        <style>
    .StripeElement {
        box-sizing: border-box;
        height: 40px;
        padding: 10px 12px;
        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }
    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }
    .StripeElement--invalid {
        border-color: #fa755a;
    }
    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>
        
	
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
    <h2>Checkout</h2>
    
    @if(session('message'))
    <div class="alert alert-success" role="alert">{{ session('message') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
@endif


    <div class="col-25">
        <div class="container">
        <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b>1</b></span></h4>
        <p><a href="#">{{$product->name}}</a> <span class="price">${{$product->price}}</span></p>
        <hr>
        <p>Total <span class="price" style="color:black"><b>${{$product->price}}</b></span></p>
   <?php /*?>      <p> <span class="price" style="color:black"><b><form action="{{url('/checkout')}}" method="post">
{{ csrf_field() }}
<input type="hidden" name="price" value="{{$product->price}}"> 
<input type="hidden" name="name" value="{{$product->name}}"> 
   <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button" id="reg_paymant_button"
            data-key="{{ config('services.stripe.key') }}"
            data-amount="{{$product->price*100}}"
            data-name="PAY NOW" 
            data-description="Stripe Payment"
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto">
            </script>
</form></b></span></p><?php 
*/?>

<p><span>
<form method="POST" action="{{url('/checkout')}}" class="card-form mt-3 mb-3">
{{ csrf_field() }}
<input type="hidden" name="price" value="{{$product->price}}"> 
<input type="hidden" name="name" value="{{$product->name}}"> 
<input type="hidden" name="payment_method" class="payment-method">
    <input class="StripeElement mb-4" name="card_holder_name" placeholder="Card holder name" required>
    <div class="col-lg-4 col-md-6">
        <div id="card-element"></div>
    </div>
    <div id="card-errors" role="alert"></div>
    <div class="form-group mt-3">
        <button type="submit" class="btn btn-primary pay">
            Purchase
        </button>
    </div>  </form></span></p>
  
        </div>
    </div>   

<div class="col-25">



<?php /*?><form action="{{url('/subscribe_process')}}" method="post">
{{ csrf_field() }} 
   <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button" id="reg_paymant_button"
            data-key="{{ config('services.stripe.key') }}"
            data-amount="{{$product->price*100}}"
            data-name="Subscribe" 
            data-description="Stripe Payment"
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto">
            </script>
</form><?php */?>
</div>
            </div>
            </div>
        </div>
    </body>
</html>

<?php /*?><script src="https://js.stripe.com/v3/"></script>

<script>
const stripe = Stripe('stripe-public-key');
const elements = stripe.elements();
const cardElement = elements.create('card');
cardElement.mount('#card-element');
const cardHolderName = document.getElementById('card-holder-name');
const cardButton = document.getElementById('card-button');
const clientSecret = cardButton.dataset.secret;
cardButton.addEventListener('click', async (e) => {
const { setupIntent, error } = await stripe.confirmCardSetup(
clientSecret, {
payment_method: {
card: cardElement,
billing_details: { name: cardHolderName.value }
}
}
);
if (error) {
// Display "error.message" to the user...
} else {
// The card has been verified successfully...
}
});
</script><?php */?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>

    let stripe = Stripe("{{  config('services.stripe.key') }}")
    let elements = stripe.elements()
    let style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    }
    let card = elements.create('card', {style: style})
    card.mount('#card-element')
    let paymentMethod = null
    $('.card-form').on('submit', function (e) {
        $('button.pay').attr('disabled', true)
        if (paymentMethod) {
            return true
        }
        stripe.confirmCardSetup(
            "{{ $intent->client_secret }}",
            {
                payment_method: {
                    card: card,
                    billing_details: {name: $('.card_holder_name').val()}
                }
            }
        ).then(function (result) {
            if (result.error) {
                $('#card-errors').text(result.error.message)
                $('button.pay').removeAttr('disabled')
            } else {
                paymentMethod = result.setupIntent.payment_method
                $('.payment-method').val(paymentMethod)
                $('.card-form').submit()
            }
        })
        return false
    })
	</script>

