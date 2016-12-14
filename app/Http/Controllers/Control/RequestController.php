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

    public function se()
    {
        $rows=DB::table('se_info_detail')
            ->orderBy('id','desc')
            ->paginate(20);
        return view('control.request_se_list',compact('rows'));
    }

    public function request_modify(Request $request)
    {
        $action=$request->input('action');
        $id=$request->input('id');
        switch ($action){
            case 'se_offline':
                DB::table('se_info_detail')
                    ->where('id',$id)
                    ->update(['online'=>'0']);
                return redirect()->back();
                break;
            case 'se_online':
                DB::table('se_info_detail')
                    ->where('id',$id)
                    ->update(['online'=>'1']);
                return redirect()->back();
                break;
        }
    }
}
