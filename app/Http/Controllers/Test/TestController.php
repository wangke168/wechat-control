<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\WeChat\Api;
use App\WeChat\Usage;
use App\WeChat\Zone;
use Carbon\Carbon;
use EasyWeChat\Foundation\Application;
use App\WeChat\Count;
use EasyWeChat\Message\Text;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Intervention\Image\Facades\Image;


class TestController extends Controller
{

    public $usage;
    public $app;
    public $qrcode;
    public $zone;
    public $staff;
    public $session;
    public $material;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->qrcode = $this->app->qrcode;
        $this->staff = $app->staff;
        $this->usage = new Usage();
        $this->zone = new Zone();
        $this->session = $app->staff_session; // 客服会话管理

        $this->material = $app->material;
    }

    public function test()
    {
        $token_url = "https://wechat.hdymxy.com/hd-token";
//        $ACCESS_TOKEN = file_get_contents($token_url);
//        return $ACCESS_TOKEN;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$token_url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;

        /*$api=new Api();
        $result= $api->get_wechat_api();
        return $result['token'];*/



        //初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, 'https://weix.hengdianworld.com/sendmessage/tglm');
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 1);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, 1);
        //设置post数据
        $post_data = array(
            "sellid" => "V1704110540",
            "eventkey" => "91",
            "uid"=>'717767313233343536'
        );
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        //执行命令
        curl_exec($curl);
        //关闭URL请求
        curl_close($curl);
        //显示获得的数据
//        print_r($data);
       /* $f='thin_pig';
        $row=DB::table('wx_qrscene_info')
            ->join('qyh_user_info',function($join)use($f){
                $join->on('wx_qrscene_info.qrscene_id','=','qyh_user_info.eventkey')
                    ->where('qyh_user_info.userid','=',$f);
            })->first();
        dd($row->userid);*/

   /*     $result = $this->material->lists('voice', 0, 20);
        return $result;*/

     /*   $count = $result->total_count;

        $items = $result->item;

//        return $items;

        foreach ($items as $item) {
            echo $item['media_id'];

            $row = DB::table('wx_voice_request')
                ->where('media_id', $item['media_id'])
                ->count();
            if ($row > 0) {
                DB::table('wx_voice_request')
                    ->insert(['media_id' => $item['media_id'], 'remark' => $item['name']]);
            }
        }

        return $this->session->lists('kf2001@u_hengdian');


        return $this->session->get('o2e-YuBgnbLLgJGMQykhSg_V3VRI');*/

        //    $this->session->close('kf2001@u_hengdian', 'o2e-YuBgnbLLgJGMQykhSg_V3VRI');

        //   return $this->staff->lists();

//          return $this->session->create('kf2001@u_hengdian', 'o2e-YuBgnbLLgJGMQykhSg_V3VRI');


      /*  $online= $this->staff->onlines();

        if(empty($online['kf_online_list']))
        {
            return 'sad';
        }

        //  $this->staff->create('test1@gh_fa1b742c0244', '客服1');
        $this->staff->delete('test1@gh_fa1b742c0244');*/


    }


    private function decode_mime($string)
    {
        $pos = strpos($string, '=?');
//        return $pos;
        if (!is_int($pos)) {
            return $string;
        } else {
//            return $string;
        }
    }

    public function index()
    {
        $from = date("Y-m-d", strtotime("-1 day"));
        $to = date("Y-m-d");
        echo $from;
        echo $to;
        $row = DB::table('wx_order_send')
            //           ->whereDate('adddate', '>=', '2016-10-12')
            //           ->whereDate('adddate', '<', '2016-10-13')
            ->whereDate('adddate', '>=', date("Y-m-d", strtotime("-1 day")))
            ->whereDate('adddate', '<', date("Y-m-d"))
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

        $row_add = DB::table('wx_user_dairy_detail')
            ->orderBy('id', 'desc')
            ->take(15)
            ->get();
        $i = 1;
        $row_add = array_reverse($row_add);
        foreach ($row_add as $key => $row_test) {
            $add[] = array('date' => $i, 'numbers' => $row_test->add);
            $esc[] = array('date' => $i, 'numbers' => $row_test->esc);
            $i = $i + 1;
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

        $info = array('add' => $add, 'esc' => $esc);
        return response()->json($info)->setCallback($request->input('callback'));
    }

    public function take_esc_json(Request $request)
    {
        for ($x = 100; $x <= 130; $x++) {
            $y = $x - 1;
            $from = date("Y-m-d", strtotime("-" . $x . " day"));
            $to = date("Y-m-d", strtotime("-" . $y . " day"));
            $row = DB::table('wx_user_esc')
                /*  ->whereDate('adddate', '>=', '2016-10-12')
                  ->whereDate('adddate', '<', '2016-10-13')   */
                ->whereDate('esc_time', '>=', $from)
                ->whereDate('esc_time', '<', $to)
                ->count();
            $date = strtotime("2002-02-20 UTC") * 1000;
            $info[] = array('name' => $date, 'passwd' => $row);
//            $info[] = array(['name' => 'LaravelAcademy', 'passwd' => $row]);
        }
//        echo $row;
        return response()->json($info)->setCallback($request->input('callback'));
    }
}