<div class="row mb-4">
    <div class="col-md-12">
        <div class="card" style="background-image: url('{{ url('/images/jumbotron.png') }}')">
           <div class="text-center text-white d-flex align-items-center py-5 px-4 my-5">
               <div class="col-5">
                   <img src="{{$course->pathAttachment()}}" class="img-fluid">
               </div>
               <div class="col-5 text-left">
                   <h1>{{__('app.courses.course_name')}} : {{$course->name}}</h1>
                   <h4>{{__('app.courses.teacher_name')}}:{{$course->teacher->user->name}}</h4>
                   <h5>{{__('app.courses.category_name')}}: {{$course->category->name}}</h5>
                   <h5>{{__('app.courses.publish')}}: {{$course->created_at->format('d/m/Y')}}</h5>
                   <h5>{{__('app.courses.updated')}}:{{$course->updated_at->format('d/m/Y')}}</h5>
                   <h6>{{__('app.courses.students')}}: {{$course->students_count}}</h6>
                   <h6>{{__('app.courses.reviews')}}: {{$course->reviews_count}}</h6>
                   @include('partials.courses.rating', ['rating' => $course->custom_rating])
               </div>
               <div class="col-2">
                   @include('partials.courses.action_button')
               </div>
           </div>
        </div>
    </div>
</div>
