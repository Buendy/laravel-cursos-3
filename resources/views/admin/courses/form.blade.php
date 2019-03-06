@extends('layouts.app')

@section('jumbotron')
    @include('partials.jumbotron', [
        'title' => __('app.courses.form.title'),
        'icon' => 'edit'
    ])
@endsection

@section('content')
    <div class="pl-5 pr-5">
        <form method="post"
              action="{{ route('admin.courses.update', ['slug' => $course->slug]) }}"
              novalidate
              enctype="multipart/form-data"
        >
            @csrf
                @method('PUT')


            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            {{ __('app.courses.form.card_header') }}
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">
                                    {{ __('app.courses.form.label_name') }}
                                </label>
                                <div class="col-md-6">
                                    <input type="text" name="name" id="name"
                                           class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                           value="{{ old('name') ?: $course->name }}"
                                           required
                                           autofocus
                                    >
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="level_id" class="col-md-4 col-form-label text-md-right">
                                    {{ __('app.courses.form.label_level') }}
                                </label>
                                <div class="col-md-6">
                                    <select name="level_id" id="level_id" class="form-control">
                                        @foreach(\App\Level::pluck('name', 'id') as $id => $level)
                                            <option {{ (int) old('level_id') === $id || $course->level_id === $id ? 'selected' : ''}} value="{{ $id }}">
                                                {{ $level }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="category_id" class="col-md-4 col-form-label text-md-right">
                                    {{ __('app.courses.form.label_category') }}
                                </label>
                                <div class="col-md-6">
                                    <select name="category_id" id="category_id" class="form-control">
                                        @foreach(\App\Category::pluck('name', 'id') as $id => $category)
                                            <option {{ (int) old('category_id') === $id || $course->category_id === $id ? 'selected' : ''}} value="{{ $id }}">
                                                {{ $category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group ml-3 mr-2">
                                <div class="col-md-6 offset-4">
                                    <input
                                        type="file"
                                        class="custom-file-input{{ $errors->has('picture') ? ' is-invalid' : '' }}"
                                        id="picture"
                                        name="picture"
                                    >
                                    <label for="picture" class="custom-file-label">
                                        {{ __('app.courses.form.label_picture') }}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    for="description"
                                    class="col-md-4 col-form-label text-md-right"
                                >
                                    {{ __('app.courses.form.label_description') }}
                                </label>
                                <div class="col-md-6">
                                    <textarea
                                        class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                        name="description"
                                        id="description"
                                        required
                                        rows="8"
                                    >{{ old('description') ?: $course->description }}</textarea>

                                    @if($errors->has('description'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('app.courses.form.card_header2') }}</div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="requirement1"
                                       class="col-md-4 col-form-label text-md-right"
                                >
                                    {{ __('app.courses.form.label_requeriment1') }}
                                </label>
                                <div class="col-md-6">
                                    <input
                                        id="requirement2"
                                        class="form-control{{ $errors->has('requirements.1') ? ' is-invalid' : '' }}"
                                        name="requirements[]"
                                        value="{{ old('requirements.1') ? old('requirements.1') : ($course->requirements_count > 1 ? $course->requirements[1]->requirement : '') }}"
                                    >
                                    @if ($errors->has('requirements.1'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('requirements.1') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                @if ($course->requirements_count > 0)
                                    <input type="hidden" name="requirement_id0"
                                           value="{{ $course->requirements[0]->id }}"
                                    >
                                @endif
                            </div>
                            <div class="form-group row">
                                <label for="requirement2"
                                       class="col-md-4 col-form-label text-md-right"
                                >
                                    {{ __('app.courses.form.label_requeriment2') }}
                                </label>
                                <div class="col-md-6">
                                    <input type="text"
                                           id="requirement2"
                                           class="form-control {{ $errors->has('requirements.1') ? 'is-invalid' : '' }}"
                                           name="requirements[]"
                                           value="{{ old('requirements.1') ? old('requirements.1') : ($course->requirements_count > 0 ? $course->requirements[1]->requirement : '') }}"
                                    >
                                    @if ($errors->has('requirements.1'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('requirements.1') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                @if ($course->requirements_count > 0)
                                    <input type="hidden" name="requirement_id1"
                                           value="{{ $course->requirements[1]->id }}"
                                    >
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('app.courses.form.card_header3') }}</div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="goal1"
                                       class="col-md-4 col-form-label text-md-right"
                                >
                                    {{ __('app.courses.form.label_goal1') }}
                                </label>
                                <div class="col-md-6">
                                    <input type="text"
                                           id="goal1"
                                           class="form-control {{ $errors->has('goals.0') ? 'is-invalid' : '' }}"
                                           name="goals[]"
                                           value="{{ old('goals.0') ? old('goals.0') : ($course->goals_count > 0 ? $course->goals[0]->goal : '') }}"
                                    >
                                    @if ($errors->has('goals.0'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('goals.0') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                @if ($course->goals_count > 0)
                                    <input type="hidden" name="goal_id0"
                                           value="{{ $course->goals[0]->id }}"
                                    >
                                @endif
                            </div>
                            <div class="form-group row">
                                <label for="goal2"
                                       class="col-md-4 col-form-label text-md-right"
                                >
                                    {{ __('app.courses.form.label_goal2') }}
                                </label>
                                <div class="col-md-6">
                                    <input type="text"
                                           id="goal2"
                                           class="form-control {{ $errors->has('goals.1') ? 'is-invalid' : '' }}"
                                           name="goals[]"
                                           value="{{ old('goals.1') ? old('goals.1') : ($course->goals_count > 0 ? $course->goals[1]->goal : '') }}"
                                    >
                                    @if ($errors->has('goals.1'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('goals.1') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                @if ($course->goals_count > 0)
                                    <input type="hidden" name="goal_id1"
                                           value="{{ $course->goals[1]->id }}"
                                    >
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row mb-0">
                                <div class="col-md-4 offset-5">
                                    <button type="submit" name="revision" class="btn btn-danger">
                                        {{ $btnText }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
