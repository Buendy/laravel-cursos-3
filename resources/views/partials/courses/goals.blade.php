<div class="col-12 pt-0 mt-0">
    <h2 class="text-muted">{{__('app.courses.goals')}}</h2>
    <hr>
</div>
@forelse($goals as $goal)
    <div class="col-md-6">
        <div class="card bg-light p-3">
            <p class="mb-0">
                {{$goal->goal}}
            </p>
        </div>
    </div>


    @empty
<div class="alert alert-dark">
    <i class="fa fa-info-cicle"></i>
    {{__('app.course.no_goals')}}
</div>

@endforelse
