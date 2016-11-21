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
        $from=date('Y-m-d', mktime(0,0,0,date('n'),1,date('Y')));
        $to=date('Y-m-d');
        \Session::flash('from',$from);
        \Session::flash('to', $to);
        $rows=DB::table('wx_click_hits')
            ->select(DB::raw('count(*) as count,click'))
            ->whereDate('adddate', '>=', $from)
            ->whereDate('adddate', '<', $to)
            ->groupBy('click')
            ->get();
//            return $rows;
        return view('control.count_menu_click',compact('rows'));
    }

    public function countSearch(Request $request)
    {

//        dd($request->all());

        $action=$request->input('action');
        $from=$request->input('from');
        $to=$request->input('to');
        \Session::flash('from',$from);
        \Session::flash('to',$to);
        switch ($action){
            case 'menu':
                $rows=DB::table('wx_click_hits')
                    ->select(DB::raw('count(*) as count,click'))
                    ->whereDate('adddate', '>=', $from)
                    ->whereDate('adddate', '<', $to)
                    ->orderBy('click','asc')
                    ->groupBy('click')

                    ->get();
//            return $rows;
                return view('control.count_menu_click',compact('rows'));
                break;
            default:
                break;
        }
    }

}
