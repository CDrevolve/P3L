<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\PasswordReset;

class ForgetPasswordController extends Controller
{
    //
    function forgetPassword()
    {
        return view('forgetPassword');
    }

    function forgetPasswordPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);
        //send email
        $token = Str::random(length: 64);
    }


    function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        //send email
        return redirect()->back()->with('message', 'Email sent');
    }
}
