<?php
namespace App\Http\Controllers\Control;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use DB;

class QrlistController extends Controller
{
    public function index(Request $request)
    {
        $classid=$request->input('classid');

        $rows=DB::table('wx_qrscene_info')
            ->where('classid',$classid)
            ->where('parent_id','')
            ->get();

        return view('control.qrlist',compact('rows'));
    }

    public function test(Request $request)
    {
        $classid=$request->input('classid');

        $rows=DB::table('wx_qrscene_info')
            ->where('classid',$classid)
            ->where('parent_id','')
            ->get();

        return view('control.qrlist1',compact('rows'));
    }
}
