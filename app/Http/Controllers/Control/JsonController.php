<?php

namespace App\Http\Controllers\Control;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use DB;
class JsonController extends Controller
{

    public function qrscene()
    {
//        return '12';
     $rows=DB::table('wx_qrscene_info')
         ->whereNotIn('classid', [3])
          ->orderBy('id','asc')
          ->get();
//        return $rows;
        $i=1;
        foreach($rows as $row)
        {
            $qrscene_info[]=$row->qrscene_name;
            $i=$i+1;
        }
        $qrscene_name=array("name"=>$qrscene_info);

        return response()->json($qrscene_name)->setCallback(request()->input('callback'));
/*
        $p1 = array('id' => "1",'text'=>"java");
        $p2 = array('id' => "2",'text'=>"jvm");
        $test = array(1=>$p1,2=>$p2);
        $params['responseData'] = $test;
      //  $this->view->disable();
        return response()->json($params);*/

    }

    public function take_order(Request $request)
    {
        /*for ($x=-16; $x<=-1; $x++) {
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
            $send[] = array('date' => $z, 'numbers' => $row_send);
            $other[] = array('date' => $z, 'numbers' =>$row_confirm-$row_send);
        }*/
        $row_add=DB::table('wx_order_dairy_detail')
            ->orderBy('id','desc')
            ->take(15)
            ->get();
        $i=1;
        $row_add=array_reverse($row_add);
        foreach ($row_add as $key=>$row_test)
        {
            $send[] = array('date' => $i, 'numbers' => $row_test->confirm);
            $other[] = array('date' => $i, 'numbers' => $row_test->submit-$row_test->confirm);
            $i=$i+1;
        }
        $info=array('send'=>$send,'other'=>$other);
        return response()->json($info)->setCallback($request->input('callback'));

    }
}
