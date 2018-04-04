<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

session_start();

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */



    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function showRegistrationForm()
    {
        if (isset($_SESSION["Team"]))
        {
            return redirect()->route('home')->with('errors', ['You are already logged in.']);
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        if (isset($_SESSION["Team"]))
        {
            return redirect()->route('home')->with('errors', ['You are already logged in.']);
        }
        if($request->input('team')=='' || $request->input('P1')=='' || $request->input('Mob1')=='' || ($request->input('P2')=='' && $request->input('Mob2')!='') || ($request->input('P2')!='' && $request->input('Mob2')=='') || $request->input('password')=='' || $request->input('password_confirmation')=='')
        {
            return back()->withInput()->with('errors', ['Please fill in the required fields']);
        }
        if($request->input('password') != $request->input('password_confirmation'))
        {
            return back()->withInput()->with('errors', ['Passwords did not match']);
        }
        if (strlen($request->input('password'))<5)
        {
            return back()->withInput()->with('errors', ['Password length too short']);
        }

        $Team = User::where('team', $request->input('team'))->first();
        if ($Team)
        {
            return back()->withInput()->with('errors', ['Team already exists']);
        }

        $Team = User::create([
            'team' => $request->input('team'),
            'participant1' => $request->input('P1'),
            'mobile_no1' => $request->input('Mob1'),
            'participant2' => $request->input('P2'),
            'mobile_no2' => $request->input('Mob2'),
            'password' => $request->input('password')]);
        if ($Team)
        {
            return redirect()->route('login')->with('success','Registered successfully. login with your credentials');
        }
    }

}
