<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

class TestController extends Controller
{


    public function test()
    {
        return base64_decode('?6ZmE5Lu25rWL6K+V');


    }


    private function decode_mime($string)
    {
        $pos = strpos($string, '=?');
//        return $pos;
        if (!is_int($pos)) {
            return $string;
        }
        else{
//            return $string;
        }
    }

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

    public function take_add_json(Request $request)
    {
//        $info[]=array('root'=>'add');
        for ($x=-16; $x<=-1; $x++) {
            $y=$x+1;
            $z=$x+16;
            $from = date("Y-m-d", strtotime($x." day"));
            $to = date("Y-m-d", strtotime($y." day"));
            $row = DB::table('wx_user_add')

                ->whereDate('adddate', '>=', $from)
                ->whereDate('adddate', '<', $to)
                ->count();
            $date=strtotime("2002-02-20 UTC") * 1000;
            $add[] = array('date' => $z, 'numbers' => $row);
        }


        for ($x=-16; $x<=-1; $x++) {
            $y=$x+1;
            $z=$x+16;
            $from = date("Y-m-d", strtotime($x." day"));
            $to = date("Y-m-d", strtotime($y." day"));
            $row = DB::table('wx_user_esc')

                ->whereDate('esc_time', '>=', $from)
                ->whereDate('esc_time', '<', $to)
                ->count();
            $date=strtotime("2002-02-20 UTC") * 1000;
            $esc[] = array('date' => $z, 'numbers' => $row);
        }


        $info=array('add'=>$add,'esc'=>$esc);
        return response()->json($info)->setCallback($request->input('callback'));
    }

    public function take_esc_json(Request $request)
    {
        for ($x=100; $x<=130; $x++) {
            $y=$x-1;
            $from = date("Y-m-d", strtotime("-".$x." day"));
            $to = date("Y-m-d", strtotime("-".$y." day"));
            $row = DB::table('wx_user_esc')
                /*  ->whereDate('adddate', '>=', '2016-10-12')
                  ->whereDate('adddate', '<', '2016-10-13')   */
                ->whereDate('esc_time', '>=', $from)
                ->whereDate('esc_time', '<', $to)
                ->count();
            $date=strtotime("2002-02-20 UTC") * 1000;
            $info[] = array('name' => $date, 'passwd' => $row);
//            $info[] = array(['name' => 'LaravelAcademy', 'passwd' => $row]);
        }
//        echo $row;
        return response()->json($info)->setCallback($request->input('callback'));
    }
}