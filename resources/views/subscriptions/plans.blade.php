
@extends('layouts.app')

@section('jumbotron')
    @include('partials.jumbotron', [
        'title' => __('app.subscriptions.subscribe'),
        'icon'  => 'globe'
    ])
@endsection

@section('content')
    <div class="container">
        <div class="pricing-table pricing-three-column row">
            <div class="plan col-sm-4 col-lg-4">
                <div class="plan-name-bronze">
                    <h2>{{ __('app.subscriptions.monthly') }}</h2>
                    <span>{{ __('app.subscriptions.price', ['price' => '9,99']) }}</span>
                </div>
                <ul>
                    <li class="plan-feature">{{ __('app.subscriptions.access_courses') }}</li>
                    <li class="plan-feature">{{ __('app.subscriptions.access_files') }}</li>
                    <li class="plan-feature">
                        @include('partials.stripe.form', [
                            'product' => [
                                'name' => __('app.subscriptions.monthly_product_name'),
                                'description' => __('app.subscriptions.monthly_product_description'),
                                'type' => 'Mensual',
                                'amount' => 999,99
                            ]
                        ])
                    </li>
                </ul>
            </div>

            <div class="plan col-sm-4 col-lg-4">
                <div class="plan-name-silver">
                    <h2>{{ trans('app.subscriptions.quarterly') }}</h2>
                    <span>{{ trans('app.subscriptions.price', ['price' => '19,99']) }}</span>
                </div>
                <ul>
                    <li class="plan-feature">{{ trans('app.subscriptions.access_courses') }}</li>
                    <li class="plan-feature">{{ trans('app.subscriptions.access_files') }}</li>
                    <li class="plan-feature">
                            @include('partials.stripe.form', [
                           'product' => [
                               'name' => __('app.subscriptions.quarterly_product_name'),
                               'description' => __('app.subscriptions.quarterly_product_description'),
                               'type' => 'Trimestral',
                               'amount' => 999,99
                             ]
                       ])

                    </li>
                </ul>
            </div>

            <div class="plan col-sm-4 col-lg-4">
                <div class="plan-name-gold">
                    <h2>{{ trans('app.subscriptions.six') }}</h2>
                    <span>{{ trans('app.subscriptions.price', ['price' => '49,99']) }}</span>
                </div>
                <ul>
                    <li class="plan-feature">{{ trans('app.subscriptions.access_courses') }}</li>
                    <li class="plan-feature">{{ trans('app.subscriptions.access_files') }}</li>
                    <li class="plan-feature">
                        <form action="{{ route('subscriptions.process_subscription') }}" method="POST">
                            @csrf
                            <input class="form-control" name="coupon" placeholder="{{ trans('app.subscriptions.coupon') }}">
                            <input type="hidden" name="plan" value="yearly">
                            <hr>
                            <stripe-form
                                stripe_key="{{ env('STRIPE_KEY') }}"
                                name="{{ trans('app.subscriptions.product_name') }}"
                                amount=8999,99
                                description="{{ trans('app.subscriptions.yearly_product_description') }}"
                            ></stripe-form>
                        </form>
                    </li>
                </ul>
            </div>

            <div class="plan col-sm-4 col-lg-4">
                <div class="plan-name-gold">
                    <h2>{{ trans('app.subscriptions.yearly') }}</h2>
                    <span>{{ trans('app.subscriptions.price', ['price' => '89,99']) }}</span>
                </div>
                <ul>
                    <li class="plan-feature">{{ trans('app.subscriptions.access_courses') }}</li>
                    <li class="plan-feature">{{ trans('app.subscriptions.access_files') }}</li>
                    <li class="plan-feature">
                        <form action="{{ route('subscriptions.process_subscription') }}" method="POST">
                            @csrf
                            <input class="form-control" name="coupon" placeholder="{{ trans('app.subscriptions.coupon') }}">
                            <input type="hidden" name="plan" value="yearly">
                            <hr>
                            <stripe-form
                                stripe_key="{{ env('STRIPE_KEY') }}"
                                name="{{ trans('app.subscriptions.product_name') }}"
                                amount=8999,99
                                description="{{ trans('app.subscriptions.yearly_product_description') }}"
                            ></stripe-form>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pricing.css') }}">
@endpush
