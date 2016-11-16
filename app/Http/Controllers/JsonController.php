<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
class JsonController extends Controller
{

    public function qrscene()
    {
     $rows=DB::table('wx_qrscene_info')
          ->orderBy('id','asc')
          ->get();
//        return $rows;
        $i=1;
        foreach($rows as $row)
        {
            $qrscene_info[]=$row->qrscene_name;
            $i=$i+1;
        }
//        $qrscene_name=array("name"=>$name);
        return response()->json($qrscene_info);
/*
        $p1 = array('id' => "1",'text'=>"java");
        $p2 = array('id' => "2",'text'=>"jvm");
        $test = array(1=>$p1,2=>$p2);
        $params['responseData'] = $test;
      //  $this->view->disable();
        return response()->json($params);*/

    }
}
