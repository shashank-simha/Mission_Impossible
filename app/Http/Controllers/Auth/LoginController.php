<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
session_start();
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function showLoginForm()
    {
        if (isset($_SESSION["Team"]))
        {
            return redirect()->route('home')->with('errors', ['You are already logged in.']);
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        if (isset($_SESSION["Team"]))
        {
            return redirect()->route('home')->with('errors', ['You are already logged in.']);
        }
        if($request->input('team')=='' || $request->input('password')=='')
        {
            return back()->withInput()->with('errors', ['Please fill in the required fields']);
        }
        $Team = User::where('team', $request->input('team'))->first();
        if ($Team)
        {
            if($Team->password != md5($request->input('password')))
            {
                return back()->withInput()->with('errors', ['Invalid login credentials']);
            }
            $_SESSION["Team"] = $Team;
            $_SESSION["attempts"] = ["stage1"=>0, "stage2"=>2, "stage3"=>0 ,"stage4"=>0];
            if ($Team->login_time == null)
            {
                $complete = $Team->update(['login_time' => now('Asia/Kolkata')]);
                return redirect('control');
            }
            return back()->withInput()->with('errors', ['Sorry something went wrong. Please try again later.']);
        }
        else
        {
            return back()->withInput()->with('errors', ['Invalid login credential']);
        }
    }
}

