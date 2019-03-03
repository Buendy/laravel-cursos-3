<div class="col-12 pt-0 mt-0">
    <h2 class="text-muted">{{ __('app.courses.requirements') }}</h2>
    <hr>
</div>
@forelse($requirements as $requirement)
    <div class="col-md-6">
        <div class="card bg-light p-3">
            <p class="mb-0">
                {{ $requirement->requirement }}
            </p>
        </div>
    </div>
@empty
    <div class="alert alert-dark">
        <i class="fa fa-info-cicle"></i>
        {{ __('app.course.no_requirements') }}
    </div>
@endforelse
