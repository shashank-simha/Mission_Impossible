<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

session_start();

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if (!isset($_SESSION["Team"]))
        {
            return redirect()->route('login')->with('errors', ['You must be logged in to view this page']);
        }
        if($_SESSION["Team"]["stage1"] == 0)
        {
            return $this->control();
        }
        return view('index');
    }

    protected function stageComplete(int $i)
    {
        if (!isset($_SESSION["Team"]))
        {
            return redirect()->route('login')->with('errors', ['You must be logged in to view this page']);
        }

        $Team = User::find($_SESSION["Team"]["id"]);
        $complete = $Team->update(['stage'.$i => 1, 'stage'.$i.'_time' => now('Asia/Kolkata'), 'stage'.$i.'_attempts' => $_SESSION["attempts"]["stage".$i]]);
    }

    public function stage(Request $request)
    {
        if($request->stage)
        {
            if($request->stage == 1)
            {
                return $this->stage1($request);
            }
            if($request->stage == 2)
            {
                return $this->stage2($request);
            }
            if($request->stage == 3)
            {
                return $this->stage3($request);
            }
            if($request->stage == 4)
            {
                return $this->stage4($request);
            }
            return view('index');
        }
        return $this->stage1($request);
    }
    public function stage1(Request $request)
    {
        $_SESSION["attempts"]["stage1"] += 1;
        if ($request->input('controlKey') == 'HGLSOYBWDMRSXW')
        {
            $this->stageComplete(1);
            $_SESSION["Team"]["stage1"] = 1;
            return redirect()->route('home');
        }
        return back();
    }
    public function stage2(Request $request)
    {
        $_SESSION["attempts"]["stage2"] += 1;
        if ($request->input('riddle_pass') == 'Bihar')
        {
            $this->stageComplete(2);
            $_SESSION["Team"]["stage2"] = 1;
            return redirect()->route('home');
        }
        return back();
    }
    public function stage3(Request $request)
    {
        $_SESSION["attempts"]["stage3"] += 1;
        if ($request->input('pacific') == '0310303130310')
        {
            $this->stageComplete(3);
            $_SESSION["Team"]["stage3"] = 1;
            return redirect()->route('home');
        }
        return back();
    }
    public function stage4(Request $request)
    {
        $_SESSION["attempts"]["stage4"] += 1;
        if ($request->post('abort_pass') == '11101010')
        {
            $this->stageComplete(4  );
            $_SESSION["Team"]["stage4"] = 1;
            return "1";
        }
        return "0";
    }
    public function control()
    {
        if (!isset($_SESSION["Team"]))
        {
            return redirect()->route('login')->with('errors', ['You must be logged in to view this page']);
        }
        if($_SESSION["Team"]["stage1"] != 0)
        {
            return redirect()->route('home');
        }
        return view('control');
    }

    public function getLoginTime()
    {
        if (!isset($_SESSION["Team"]))
        {
            return 0;
        }
        return User::find($_SESSION["Team"]["id"])->login_time;
    }
}
