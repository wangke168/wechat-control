<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{
    public function signin()
    {
   /*     if (session('username')) {
            return session('username');
        } else {
            return view('control.login');
        }*/
        return view('control.login');

    }

    public function login(Request $request)
    {

        /* if (Auth::attempt([
             'username' => $request->get('username'),
             'password' => $request->get('password'),
         ]))
         {
             return redirect('/control/index');
         } else {
             dd($request->all());
         }*/
        $username = $request->get('username');
        $password = $request->get('password');
        $password = md5($password);
        $userinfo = User::where('username', $username)->where('password', $password)->first();

        if ($userinfo) {
//            $request->session()->put('username', $username);
            return redirect('/control/index');
        } else {
//            return $request->all();
//            \Session::flash('user_login','failed');
            return redirect('/control/login')->withInput();
        }
    }

    public function logout()
    {
        \Session::clear();
        return \Redirect::action('UsersController@login');
    }
}
