@extends('layouts.app')

@section('jumbotron')
    @include('partials.jumbotron', ['title'=> __('app.courses.subscribed'), 'icon' => 'table'])

    @endsection


@section('content')
<div class="pl-5 pr-5">
    <div class="row justify-content-center">
        @forelse($courses as $course)
            <div class="col-md-3">
                @include('partials.courses.card_course')
            </div>

            @empty
                <div class="alert alert-dark">{{__('app.courses.no_subscribed')}}</div>

        @endforelse
    </div>
</div>

    @endsection