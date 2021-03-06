<?php

namespace App\Http\Controllers\Admin;

use App\Student;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::where('role_id', '3')->paginate(10);
        //dd($students);
        return view('admin.students.index', compact('students'));
    }

    public function edit(user $user)
    {
        return view('admin.students.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, User::$rules, User::$messages);
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->save();
        return back();

    }

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
