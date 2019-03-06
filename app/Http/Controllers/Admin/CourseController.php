<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\CourseRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::paginate(10);
        return view('admin.courses.index', compact('courses'));
    }

    public function edit($slug)
    {
        $course = Course::with(['requirements', 'goals'])
            ->withCount(['requirements', 'goals'])
            ->whereSlug($slug)
            ->first();
        $btnText = __('app.courses.form.btn_edit');
        return view('admin.courses.form', compact('course', 'btnText'));
    }

    public function update(AdminRequest $request, Course $slug)
    {

        $this->validate($request, [ 'name' => [Rule::unique('courses', 'name')->ignore($slug->id)]]);

        if ($request->hasFile('picture')) {
            Storage::delete('courses/' . $slug->picture);
            $picture = Helper::uploadFile('picture', 'courses');
            $request->merge(['picture' => $picture]);
        }
        $slug->fill($request->input())->save();

        return redirect()->route('manage.courses')->with('message', ['success', __('app.courses.update_message')]);
    }

    public function activate(Course $slug)
    {
        $slug->status = Course::PENDING;
        $slug->save();
        return back()->with('message', ['success', __('app.courses.store_message')]);
    }

    public function publish(Course $slug)
    {
        $slug->status = Course::PUBLISHED;
        $slug->save();
        return back()->with('message', ['success', __('app.courses.store_message')]);
    }

    public function cancel(Course $slug)
    {
        $slug->status = Course::REJECTED;
        $slug->save();
        return back()->with('message', ['success', __('app.courses.store_message')]);
    }

}
