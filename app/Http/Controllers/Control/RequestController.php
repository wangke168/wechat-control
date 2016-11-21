<?php

namespace App\Http\Controllers\Control;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use DB;

class RequestController extends Controller
{
    public function txt()
    {
        $rows=DB::table('wx_txt_request')
            ->orderBy('id','desc')
            ->paginate(20);
        return view('control.request_txt_list',compact('rows'));
    }
}
