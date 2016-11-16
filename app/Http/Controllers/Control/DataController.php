<?php
namespace App\Http\Controllers\Control;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use DB;

class DataController extends Controller
{
    public function click(Request $request)
    {
/*
        $rows=DB::table('wx_click_hits')
            ->whereDate('adddate', '>=', '2016-10-12')
            ->whereDate('adddate', '<', '2016-10-13')
            ->groupBy('click')
            ->count();*/

        $rows=DB::table('wx_click_hits')
            ->select(DB::raw('count(*) as count,click'))
            ->whereDate('adddate', '>=', '2016-10-11')
            ->whereDate('adddate', '<', '2016-10-13')
            ->groupBy('click')
            ->get();
//            return $rows;
        return view('control.count_click',compact('rows'));
    }


}
