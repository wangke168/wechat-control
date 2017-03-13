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
//        $stats = $this->material->stats();
        $voice_count = $this->material->stats()->voice_count;
//        return voice_count;

        $i = 0;

        do {
            echo "这个数字是：$i <br>";

            $j = $i + 10;

            if ($voice_count-$j>10) {
                $result = $this->material->lists('voice', $i, $j);
            }
            else{
                $result = $this->material->lists('voice', $i, ($voice_count-$j));
            }
            $items = $result->item;
            foreach ($items as $item) {
                echo $item['media_id']."<br>";

               /* $row = DB::table('wx_voice_request')
                    ->where('media_id', $item['media_id'])
                    ->count();
                if ($row > 0) {
                    DB::table('wx_voice_request')
                        ->insert(['media_id' => $item['media_id'], 'remark' => $item['name']]);
                }*/
            }
            $i = $i + 10;

//            echo "这个数字是：$i <br>";
        } while ($i <= $voice_count);

        return $voice_count;
        /*  for ($i=0;$i<=$voice_count;$i=$i+10)
          {
              $j=$i+10;
              $result= $this->material->lists('voice', 0, 20);
              echo $i;
          }*/
        $result = $this->material->lists('voice', 0, 20);
        return $result;

        $count = $result->total_count;

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


        return $this->session->get('o2e-YuBgnbLLgJGMQykhSg_V3VRI');

        //    $this->session->close('kf2001@u_hengdian', 'o2e-YuBgnbLLgJGMQykhSg_V3VRI');

        /*   return $this->staff->lists();

          return $this->session->create('kf2001@u_hengdian', 'o2e-YuBgnbLLgJGMQykhSg_V3VRI');*/


        return $this->staff->onlines();

        //  $this->staff->create('test1@gh_fa1b742c0244', '客服1');
        $this->staff->delete('test1@gh_fa1b742c0244');


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