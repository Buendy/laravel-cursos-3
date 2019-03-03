<?php

namespace App\Http\Controllers;

use App\Course;
use App\Mail\MessageToStudent;
use App\Student;
use App\User;
use Dompdf\Exception;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function students()
    {
        $students = Student::with('user', 'courses.reviews')
            ->whereHas('courses', function($query){
                $query->where('teacher_id', auth()->user()->teacher->id)
                    ->select('id', 'teacher_id', 'name')
                    ->withTrashed();
            })->get();

        $actions = 'students.datatable.actions';


    }

    public function courses()
    {
        $courses = Course::withCount(['students'])
        ->with('category', 'reviews')
        ->whereTeacherId(auth()->user()->id)
        ->paginate(12);

        return view('teachers.courses', compact('courses'));

    }

    public function sendMessageToStudent(Request $request)
    {
        $info = $request->info;
        $data = [];
        parse_str($info, $data);
        $user = User::findOrFail($data('user_id'));
        try{
            Mail::to($user)->send(new MessageToStudent(auth()->name, $data));
            $success = true;
        }catch (Exception $exception){
            $success = false;

        }
        return response()->json(['res' => $success]);
    }
}
