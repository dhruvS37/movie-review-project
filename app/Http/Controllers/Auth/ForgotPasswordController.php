<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function sendResetLink(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        if ($user = User::where('email', $request->input('email'))->first()) {

            $token = str_random(64);

            DB::table(config('auth.passwords.users.table'))->updateOrInsert(['email' => $user->email], ['token' => $token]);

            return redirect()->back()->with('resetLink', "password/reset/$token");
        }
        return redirect()->back()->withErrors(['email' => trans(Password::INVALID_USER)]);
    }
}
