@extends('layouts.app')

@section('jumbotron')
    @include('partials.jumbotron', ['title' => __(''), 'icon' => 'user-circle'])
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endpush

@section('content')
    <div class="pl-5 pr-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('app.profile.index.form_header_edit') }}
                    </div>
                    <div class="card-body">
                        <form method='POST' action="{{ url('/manage/students/' . $user->id . '/update')  }}" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">
                                    {{ __('app.profile.index.name') }}
                                </label>
                                <div class="col-md-6">
                                    <input
                                        id="name"
                                        type="text"
                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        name="name"
                                        value="{{ old('name') ?: $user->name }}"
                                        required
                                        autofocus
                                    >

                                    @if($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="las_name" class="col-md-4 col-form-label text-md-right">
                                    {{ __('app.profile.index.last_name') }}
                                </label>
                                <div class="col-md-6">
                                    <input
                                        id="last_name"
                                        type="text"
                                        class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                        name="last_name"
                                        value="{{ old('last_name') ?: $user->last_name }}"
                                        required
                                        autofocus
                                    >

                                    @if($errors->has('last_name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">
                                    {{ __('app.profile.index.email') }}
                                </label>
                                <div class="col-md-6">
                                    <input
                                        id="email"
                                        type="email"
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        name="email"
                                        value="{{ old('email') ?: $user->email }}"
                                        required
                                        autofocus
                                    >

                                    @if($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('app.profile.index.button') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>


@endsection

@push('scripts')
@endpush
