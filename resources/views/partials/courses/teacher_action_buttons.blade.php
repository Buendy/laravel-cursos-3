<div class="btn-group">
    @if((int) $course->status === \App\Course::PUBLISHED)
        @include('partials.courses.btn_detail')
        @include('partials.courses.btn_edit')
        @include('partials.courses.btn_form_delete')
    @elseif((int) $course->status === \App\Course::PENDING)
        <a class="btn btn-primary text-white" href="#">
            <i class="fa fa-history"></i> {{ __('app.teachers.courses.button_pending') }}
        </a>
        @include('partials.courses.btn_detail')
        @include('partials.courses.btn_edit')
        @include('partials.courses.btn_form_delete')
    @else
        <a class="btn btn-danger text-white" href="#">
            <i class="fa fa-pause"></i> {{ __('app.teachers.courses.button_rejected') }}
        </a>
        @include('partials.courses.btn_form_delete')
    @endif
</div>
