<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //

    public function login(Request $request){
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(["email" => $request->email, "password" => $request->password, "status" => 1], $request->remember)) {
            $request->session()->regenerate();
            return redirect('/');
        } else {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

    }

    public function logout(Request $request)
    {

        if(Auth::check()){
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        return redirect()->route('login');

    }

}
