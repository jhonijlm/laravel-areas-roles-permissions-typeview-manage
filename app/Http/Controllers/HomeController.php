<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //


    public function index(){
        if(Auth::check() ){
            if(Auth::user()->can("hasArea", ["administrator"])){
                return redirect()->route('administrator.dashboard');
            }

            if(Auth::user()->can("hasArea", ["manager"])){
                return redirect()->route('manager.dashboard');
            }

            if(Auth::user()->can("hasArea", ["employee"])){
                return redirect()->route('employee.dashboard');
            }

        }

        abort(403);
    }
}
