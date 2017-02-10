<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\WeChat\Usage;
use EasyWeChat\Foundation\Application;
use App\WeChat\Count;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Intervention\Image\Facades\Image;
class TestController extends Controller
{

    public $usage;
    public $app;
    public $qrcode;
    public function __construct(Application $app)
    {
        $this->app=$app;
        $this->qrcode=$this->app->qrcode;
        $this->usage=new Usage();
    }
    public function test()
    {

        $row=DB::table('wx_qrscene_temp_info')
            ->where('qrscene_id','1306')
            ->first();
        $qr_id=$row->qrscene_id;
        $qr_expire=$row->expireseconds*60;
        if ($row->qrscene_logo) {
            $qr_logo = $row->qrscene_logo;
        }
        else{
            $qr_logo='qr/logo.png';
        }

//        $qrcode = $this->app->qrcode;
        $result = $this->qrcode->temporary($qr_id, $qr_expire);
        $ticket = $result->ticket;// 或者 $result['ticket']
//        $expireSeconds = $result->expire_seconds; // 有效秒数
//        $url = $result->url; // 二维码图片解析后的地址，开发者可根据该地址自行生成需要的二维码图片

        /*$QR = $this->qrcode->url($ticket);
        $logo=$qr_logo;
        $img = Image::make($QR);
        $img->insert($logo, 'center');
        return $img->response('png');*/
        $QR = $this->qrcode->url($ticket);
        $logo=$qr_logo;
        $img = Image::make($QR);
        $img->insert($logo, 'center');
        return $img->response('png');
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