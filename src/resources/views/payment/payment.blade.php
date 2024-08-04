@extends('layouts.app')

@section('content')
    <h1>決済ページ</h1>
    <form action="{{ route('payment.process') }}" method="POST">
        @csrf
        <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="{{ env('STRIPE_KEY') }}"
            data-amount="100"
            data-name="Stripe決済デモ"
            data-label="決済をする"
            data-description="これはデモ決済です"
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto"
            data-currency="JPY">
        </script>
    </form>
@endsection
