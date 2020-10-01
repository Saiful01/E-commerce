<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
{
    public function __construct()
    {/*
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                return Redirect::to('/admin/home');
            }
            return $next($request);
        });*/
    }


    public function login()
    {
        return view('admin.pages.login.index');
    }


    public function doLogin(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $email = $request['email'];
        $password = $request['password'];
        $remember = true;

        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {

            $user = User::where('email', $email)->first();
            $request->session()->put('id', $user->id);
            $request->session()->put('name', $user->name);
            $request->session()->put('user_type', $user->user_type);

            return Redirect::to('/admin/dashboard');
        } else {
            return back()->with('failed', "Email or password does not match");

        }
    }

    public function doLogout()
    {
        Auth::logout(); // log the user out of our application
        Session::flush();
        return Redirect::to('/admin/login');
    }
}
