<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = User::where('role_id', '2')->paginate(10);
        //dd($teachers);
        return view('admin.teachers.index', compact('teachers'));
    }

    public function edit(user $user)
    {
        return view('admin.teachers.edit', compact('user'));
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
