@extends('layouts.app')

@section('jumbotron')
    @include('partials.jumbotron', [
        'icon' => 'th',
        'title' => trans('app.home.jumbotron_title')
    ])
@endsection

@section('content')
    <div class="pl-5 pr-5">
        <div class="row justify-content-center">
            @forelse($courses as $course)
                <div class="col-md-3">
                    @include('partials.courses.card_course')
                </div>
            @empty
                <div class="alert alert-dark">
                    {{ __('app.home.no_courses') }}
                </div>
            @endforelse
        </div>
        <div class="row justify-content-center">
            {{ $courses->links() }}
        </div>
    </div>
@endsection
