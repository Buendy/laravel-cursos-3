@include('partials.navigations.student_links')
<li><a href="{{route('teacher.courses')}}" class="nav-link">{{ __('menu.teacher_course') }}</a></li>
<li><a href="{{route('courses.create')}}" class="nav-link">{{ __('menu.teacher_create_course') }}</a></li>
@include('partials.navigations.loggued')


