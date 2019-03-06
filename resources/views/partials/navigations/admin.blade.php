
<li>
    <a href="{{ route('manage.courses') }}" class="nav-link">{{__('menu.admin_courses')}}</a>
</li>
<li>
    <a href="{{url('/manage/students')}}" class="nav-link">{{__('menu.admin_students')}}</a>
</li>
<li>
    <a href="{{route('admin.teachers')}}" class="nav-link">{{__('menu.admin_teachers')}}</a>
</li>
@include('partials.navigations.loggued')

