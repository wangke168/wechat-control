<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

class TestController extends Controller
{
    public function index()
    {
        $from=date("Y-m-d", strtotime("-1 day"));
        $to=date("Y-m-d");
        echo $from;
        echo $to;
        $row = DB::table('wx_order_send')
            //           ->whereDate('adddate', '>=', '2016-10-12')
            //           ->whereDate('adddate', '<', '2016-10-13')
            ->whereDate('adddate', '>=', date("Y-m-d", strtotime("-1 day")))
            ->whereDate('adddate','<',date("Y-m-d"))
            ->count();
        return $row;
    }

    public function take_json()
    {
        for ($x=1; $x<=10; $x++) {
            $y=$x-1;
            $from = date("Y-m-d", strtotime("-".$x." day"));
            $to = date("Y-m-d", strtotime("-".$y." day"));
            $row = DB::table('wx_user_add')
                /*  ->whereDate('adddate', '>=', '2016-10-12')
                  ->whereDate('adddate', '<', '2016-10-13')   */
                ->whereDate('adddate', '>=', $from)
                ->whereDate('adddate', '<', $to)
                ->count();
            $info[] = array(['name' => 'LaravelAcademy', 'passwd' => $row]);
//            $info[] = array(['name' => 'LaravelAcademy', 'passwd' => $row]);
        }
//        echo $row;
        return response()->json($info);
    }
}