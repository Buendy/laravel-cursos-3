<?php
namespace App\Http\Controllers;
use App\Course;
use App\Helpers\Helper;
use App\Http\Requests\CourseRequest;
use App\Mail\NewStudentInCourse;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class CourseController extends Controller
{
    public function show(Course $course)
    {
        $course->load([
            'category' => function($q) {
                $q->select('id', 'name');
            },
            'goals' => function($q) {
                $q->select('id', 'course_id', 'goal');
            },
            'level' => function($q) {
                $q->select('id', 'name');
            },
            'requirements' => function($q){
                $q->select('id', 'course_id', 'requirement');
            },
            'reviews.user',
            'teacher'
        ])->get();
        $related = $course->relatedCourses();
        return view('courses.detail', compact('course', 'related'));
    }
    public function inscribe(Course $course)
    {
        //$name = auth()->user()->name;
        //return new NewStudentInCourse($course, $name);
//
        $course->students()->attach(auth()->user()->student->id);

     Mail::to($course->teacher->user)->send(new NewStudentInCourse($course, auth()->user()->name));

        return back()->with('message', ['success', __('app.courses.inscribed')]);
    }

    public function addReview(Request $request)
    {
        Review::create([
            'user_id' => auth()->user()->id,
            'course_id' => $request->course_id,
            'rating' => (int) $request->rating_input,
            'comment' => $request->message
        ]);
        return back()->with('message', ['success', __('app.courses.review_thanks')]);
    }

    public function subscribed()
    {
        $courses = Course::whereHas('students', function($query) {
            $query->where('user_id', auth()->user()->id);
        })->get();
        return view('courses.subscribed', compact('courses'));
    }

    public function create()
    {
        $course = new Course();
        $btnText = __('app.courses.form.btn_create');

        return view('courses.form',compact('course','btnText'));
    }

    public function store(CourseRequest $request)
    {
        $picture = Helper::uploadFile('picture','courses');
        $request->merge(['picture' => $picture]);
        $request->merge(['teacher_id' => auth()->user()->teacher->id]);
        $request->merge(['status' => Course::PENDING]);
        Course::create($request->input());

        return back()->with('message', ['success', __('app.courses.store_message')]);
    }

    public function edit($slug)
    {
        $course = Course::with(['requirements', 'goals'])
            ->withCount(['requirements', 'goals'])
            ->whereSlug($slug)
            ->first();
        $btnText = __('app.courses.form.btn_edit');
        return view('courses.form', compact('course', 'btnText'));
    }

    public function update(CourseRequest $request, Course $course)
    {
        if ($request->hasFile('picture')) {
            Storage::delete('courses/' . $course->picture);
            $picture = Helper::uploadFile('picture', 'courses');
            $request->merge(['picture' => $picture]);
        }
        $course->fill($request->input())->save();
        return back()->with('message', ['success', __('app.courses.update_message')]);
    }

    public function destroy(Course $course)
    {
        try {
            $course->delete();
            return back()->with('message', ['success', __('app.courses.delete_message_ok')]);
        } catch (\Exception $exception) {
            return back()->with('message', ['danger', __('app.courses.delete_message_no')]);
        }
    }
}
