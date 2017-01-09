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
        $userinfo = User::where('username', $username)->where('userpwd', $password)->first();

        if ($userinfo) {
            $request->session()->put('username', $username);
            $request->session()->put('managelevel', $userinfo->managelevel);
            $request->session()->put('eventkey', $userinfo->eventkey);
            if ($userinfo->eventkey<>'all'){
                return redirect('/control/articlelist');
            }
            else {
                return redirect('/control/index');
            }
        } else {
//            return $request->all();
            \Session::flash('user_login','failed');
            return redirect('/control/login')->withInput();
        }
    }

    public function logout()
    {
        \Session::clear();
        return \Redirect::action('UsersController@login');
    }

    public function changpwd(Request $request)
    {

        $action=$request->input('action');
//        dd($request->all());
        if ($action=='modify'){

            $old_pwd=$request->input('old_pwd');
            $new_pwd=$request->input('new_pwd');
            $repeat_new_pwd=$request->input('repeat_new_pwd');
            if ($new_pwd<>$repeat_new_pwd)
            {
                \Session::flash('changpwd','failed');
                return redirect('/control/changpassword')->withInput();
            }
            elseif($new_pwd=='')
            {
                \Session::flash('changpwd','zero');
                return redirect('/control/changpassword')->withInput();
            }
            else
            {
                $old_pwd=md5($old_pwd);
                $userinfo = User::where('username', \Session::get('username'))->where('userpwd', $old_pwd)->first();
                if (!$userinfo)
                {
                    \Session::flash('changpwd','old_error');
                    return redirect('/control/changpassword')->withInput();
                }
                else {
                    $password = md5($new_pwd);
                    User::where('username', \Session::get('username'))->update(['userpwd'=>$password]);
                    \Session::flash('changpwd', 'success');
                    return redirect('/control/changpassword')->withInput();
                }
            }
        }
        else{
            return view("control.changpassword");
        }

    }
}
