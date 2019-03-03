<?php

namespace App\Http\Controllers;

use App\Rules\StrengthPassword;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user()->load('socialAccount');
        return view('profile.index',compact('user'));
    }

    public function update(Request $request)
    {
        $this->validate($request,[
           'password' => ['confirmed', new StrengthPassword]
        ]);

        $user = auth()->user();
        $user->password = bcrypt($request->password);
        $user->save();
        return back()->with('message', ['success', __('app.profile.index.message_ok')]);

    }
}
