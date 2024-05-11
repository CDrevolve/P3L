<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgetPasswordMail;


class ForgetPasswordController extends Controller
{
    //
    function forgetPassword()
    {
        return view('auth.emailPassword');
    }




    function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('message', 'We can not find a user with that email address');
        }
        //send email

        $token = Str::random(length: 64);

        $update = PasswordReset::find($user->id);

        if (!$update) {
            PasswordReset::create([
                'id_user' => $user->id,
                'token' => $token,
            ]);
        } else {
            $update->update([
                'token' => $token,
            ]);
        }

        $details = [
            'username' => $user->username,
            'website' => 'Atma Kitchen',
            'datetime' => now(),
            'url' => request()->getHttpHost() . '/forgetPassword/verify/' . $token
        ];
        Mail::to($request->email)->send(new ForgetPasswordMail($details));

        return back()->with('message', 'Email sent successfully');
    }

    function verifyToken($token)
    {
        $token = PasswordReset::where('token', $token)->first();
        if ($token) {
            return view('auth.newPasswordView', ['token' => $token->token]);
        } else {
            return "Token not valid";
        }
    }

    function forgetPasswordPost(Request $request)
    {

        $request->validate([
            'token' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required',
        ]);

        $userToken = PasswordReset::where('token', $request->token)->first();


        if ($userToken) {
            $user = User::where('id', $userToken->id_user)->first();

            $user->update([
                // 'password' => bcrypt($request->password),
                'password' => $request->password,
            ]);

            $userToken->delete();

            return redirect('login');
        } else {
            return "Keys tidak valid.";
        }
    }
}
