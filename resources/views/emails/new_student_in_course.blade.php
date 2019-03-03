@component('mail::message')
    #{{__('app.mail.new_student.title')}}
    {{__('app.mail.new_student.body', ['student' => $student, 'course' => $course->name])}}
    <img src="{{url('storage/courses'. $course->picture)}}" class="img-resposive" alt="{{$course->name}}">


    @component('mail::button', ['url' => '/courses/' . $course->slug, 'color' => 'green'])
        {{__('app.mail.new_student.button')}}
    @endcomponent

    {{__('')}}
    {{config('app.name')}}
@endcomponent

