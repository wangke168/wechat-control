<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\WeChat\Count;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

class TestController extends Controller
{


    public function test()
    {
    /*    $row = DB::table('wx_click_hits')
            ->selectRaw('count(distinct wx_openid) as total')
            ->where('click', '8')
            ->whereDate('adddate', '>=', '2017-01-1')
            ->whereDate('adddate', '<', '2017-01-14')
            ->first();

        dd($row) ;*/
/*
        $count=new Count();
        dd($count->count_menu_click('8','notrepeat','2017-01-1','2017-01-14'));*/

        for ($x=-16; $x<=-1; $x++) {
            $y=$x+1;
            $z=$x+16;
            $from = date("Y-m-d", strtotime($x." day"));
            $to = date("Y-m-d", strtotime($y." day"));
            $row_confirm = DB::table('wx_order_confirm')
                ->whereDate('adddate', '>=', $from)
                ->whereDate('adddate', '<', $to)
                ->count();

            $row_send = DB::table('wx_order_send')
                ->whereDate('adddate', '>=', $from)
                ->whereDate('adddate', '<', $to)
                ->count();
//            $other=$row_confirm-$row_send;

            DB::table('wx_order_dairy_detail')
                ->insert(['submit'=>$row_confirm,'confirm'=>$row_send,'date'=>$from]);
        }

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
   /*     for ($x=-16; $x<=-1; $x++) {
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
        }*/

        $row_add=DB::table('wx_user_dairy_detail')
            ->orderBy('id','desc')
            ->take(15)
            ->get();
        $i=1;
        $row_add=array_reverse($row_add);
        foreach ($row_add as $key=>$row_test)
        {
            $add[] = array('date' => $i, 'numbers' => $row_test->add);
            $esc[] = array('date' => $i, 'numbers' => $row_test->esc);
            $i=$i+1;
        }
//        $test=$row_add->add;
//        return $add;

      /*  for ($x=-16; $x<=-1; $x++) {
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
*/

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