<?php

namespace App\Http\Controllers\Control;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
class MessageController extends Controller
{
    public function index()
    {
        return 'asd';
        $rows=DB::table('wx_recevice_txt')
            ->orderBy('id','desc')
            ->paginate(20);
        return view("control.message",compact('rows'));
    }
}
