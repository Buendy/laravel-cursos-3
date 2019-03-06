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
                        {{ __('app.profile.index.form_header') }}
                    </div>
                    <div class="card-body">
                        <form method='POST' action="{{ route('profile.update') }}" novalidate>
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">
                                    {{ __('app.profile.index.email') }}
                                </label>
                                <div class="col-md-6">
                                    <input
                                        id="email"
                                        type="email"
                                        readonly
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

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">
                                    {{ trans('app.profile.index.password') }}
                                </label>
                                <div class="col-md-6">
                                    <input
                                        id="password"
                                        type="password"
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password"
                                        required
                                    >

                                    @if($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">
                                    {{ trans('app.profile.index.password_confirmation') }}
                                </label>
                                <div class="col-md-6">
                                    <input
                                        id="password_confirmation"
                                        type="password"
                                        class="form-control"
                                        name="password_confirmation"
                                        required
                                    >
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

                @if(! $user->teacher)
                    <div class="card">
                        <div class="card-header">
                            {{__('app.profile.index.form_teacher_header')}}
                        </div>
                        <div class="card-body">
                            <form action="{{route('solicitude.teacher')}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary btn-block">
                                    <i class="fa fa-graduation-cap">{{__('app.profile.index.form_teacher_button')}}</i>
                                </button>
                            </form>
                        </div>
                    </div>

                @else
                    <div class="card">
                        <div class="card-header">
                            {{__('app.profile.index.manage_my_courses')}}
                        </div>
                        <div class="card-body">
                            <a href="{{route('teacher.courses')}}" class="btn btn-secondary btn-block">
                                <i class="fa fa-leanpub"></i>{{__('app.profile.index.manage_now')}}
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            {{__('app.profile.index.my_students')}}
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered nowrap"
                                   cellspacing="0"
                                   id="students-table"
                            >
                                <thead>
                                <tr>
                                    <th>{{__('app.profile.index.table_students_id')}}</th>
                                    <th>{{__('app.profile.index.table_students_name')}}</th>
                                    <th>{{__('app.profile.index.table_students_email')}}</th>
                                    <th>{{__('app.profile.index.table_students_courses')}}</th>
                                    <th>{{__('app.profile.index.table_students_actions')}}</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                @endif

                @if($user->socialAccount)
                    <div class="card">
                        <div class="card-header">
                            {{_('app.profile.index.access_header')}}
                        </div>
                        <div class="card-body">
                            <button class="btn btn-outline-dark btn-block">
                                {{__('app.profile.index.access_body')}}:
                                <i class="fa fa-{{$user->sodialAccount->provider}}"></i>
                                {{$user->socialAccount->provider}}
                            </button>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
    @include('partials.modal')
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
        let dt;
        let modal = jQuery("#appModal");
        jQuery(document).ready(function() {
            dt = jQuery("#students-table").DataTable({
                pageLength: 5,
                lengthMenu: [ 5, 10, 25, 50, 75, 100 ],
                processing: true,
                serverSide: true,
                ajax: '{{ route('teacher.students') }}',
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                },
                columns: [
                    {data: 'user.id', visible: false},
                    {data: 'user.name'},
                    {data: 'user.email'},
                    {data: 'courses_formatted'},
                    {data: 'actions'}
                ]
            });
            jQuery(document).on("click", '.btnEmail', function (e) {
                e.preventDefault();
                const id = jQuery(this).data('id');
                modal.find('.modal-title').text('{{ __('app.profile.actions.title') }}');
                modal.find('#modalAction').text('{{ __('app.profile.actions.title') }}').show();
                let $form = $("<form id='studentMessage'></form>");
                $form.append(`<input type="hidden" name="user_id" value="${id}" />`);
                $form.append(`<textarea class="form-control" name="message"></textarea>`);
                modal.find('.modal-body').html($form);
                modal.modal();
            });
            jQuery(document).on("click", "#modalAction", function (e) {
                jQuery.ajax({
                    url: '{{ route('teacher.send_message_to_student') }}',
                    type: 'POST',
                    headers: {
                        'x-csrf-token': $("meta[name=csrf-token]").attr('content')
                    },
                    data: {
                        info: $("#studentMessage").serialize()
                    },
                    success: (res) => {
                        if (res.res) {
                            modal.find('#modalAction').hide();
                            modal.find('.modal-body').html('<div class="alert alert-success">{{ __('app.profile.index.modal_body_success') }}</div>');
                        } else {
                            modal.find('.modal-body').html('<div class="alert alert-danger">{{ __('app.profile.index.modal_body_danger') }}</div>');
                        }
                    }
                })
            });
        })
    </script>
@endpush
