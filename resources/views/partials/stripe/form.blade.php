<form action="{{ route('subscriptions.process_subscription') }}" method="post">
    @csrf
    <input class="form-control" name="coupon" placeholder="{{ __('app.subscriptions.coupon') }}">
    <input type="hidden" name="type" value="{{ $product['type'] }}">
    <input type="hidden" name="plan" value="{{ $product['type'] }}">
    <hr>
    <stripe-form
        stripe_key="{{ env('STRIPE_KEY') }}"
        name="{{ $product['name'] }}"
        amount="{{ $product['amount'] }}"
        description="{{ $product['description'] }}"
    ></stripe-form>
</form>
