<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\WeChat\Api;
use App\WeChat\Usage;
use App\WeChat\Zone;
use Carbon\Carbon;
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
    public $zone;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->qrcode = $this->app->qrcode;
        $this->usage = new Usage();
        $this->zone = new Zone();
    }

    public function test()
    {
        $date=Carbon::now()->toDateString();
        $rows_show=DB::table('zone_show_info')
            ->where('is_push','1')
            ->orderBy('id','desc')
            ->get();
        foreach($rows_show as $row_show)
        {
            $row_show_time=DB::table('zone_show_time')
                ->whereDate('startdate', '<=', $date)
                ->whereDate('enddate', '>=', $date)
                ->where('show_id', $row_show->id)
                ->orderBy('is_top','desc')
                ->first();

            echo $row_show->show_name.'<br>';
            echo $row_show_time->show_time.'<br>';

            $show_time=explode(',', $row_show_time->show_time);
            $prevtime = date('Y-m-d');
            foreach($show_time as $show_time_detail) {
                $temptime = (strtotime($show_time_detail) - strtotime("now")) / 60;
                echo strtotime($prevtime).'<br>';

                if ($temptime < 30 && $temptime > 0) {

                    $row1 = DB::table('wx_user_info')
                        ->where('eventkey', $row_show->eventkey)
                        ->where('scandate', date('Y-m-d'))
                        ->whereRaw('UNIX_TIMESTAMP(endtime)>=' . strtotime($prevtime))
                        ->get();

                    foreach ($row1 as $send_openid) {
                        //        $content = new Text();
                        //       $content->content = "您好，" . $zone->get_zone_name($result->zone_id,'1') . "景区" . $result->show_name . "的演出时间是" . $bbb . "。还没到剧场的话要抓紧了哦。\n如果您不知道剧场位置，<a href='" . $result->location_url . "'>点我</a>\n微信演出时间有时无法及时更新，以景区公示为准。";
                        //    $app->staff->message($content)->by('1001@u_hengdian')->to($send_openid->wx_openid)->send();

                        echo $send_openid->wx_openid . '<br>';

                    }

                }
                $prevtime = $show_time_detail;
            }

        }

//        $app=app('wechat');
//        $zone=new Tour();
/*        $row=DB::table('zone_show_info')
            ->where('is_push','1')
            ->orderBy('id','desc')
            ->get();
        foreach ($row as $result) {
            $aaa = explode(',', $result->show_time);
            $prevtime = date('Y-m-d');
            foreach ($aaa as $bbb) {
                $temptime = (strtotime($bbb) - strtotime("now")) / 60;
                if ($temptime < 30 && $temptime > 0) {

                    $row1 = DB::table('wx_user_info')
                        ->where('eventkey', $result->eventkey)
                        ->where('scandate', date('Y-m-d'))
                        ->whereRaw('UNIX_TIMESTAMP(endtime)>=' . strtotime($prevtime))
                        ->get();

                    foreach ($row1 as $send_openid) {
                        $content = new Text();
                        $content->content = "您好，" . $zone->get_zone_name($result->zone_id,'1') . "景区" . $result->show_name . "的演出时间是" . $bbb . "。还没到剧场的话要抓紧了哦。\n如果您不知道剧场位置，<a href='" . $result->location_url . "'>点我</a>\n微信演出时间有时无法及时更新，以景区公示为准。";
                        $app->staff->message($content)->by('1001@u_hengdian')->to($send_openid->wx_openid)->send();
                    }*/


                    /*检查景区eventkey下有没有其他二维码，例：龙帝惊临项目在秦王宫里，因此龙帝惊临和秦王宫的二维码是从属关系，扫龙帝惊临的二维码也能收到秦王宫的节目提醒*/
//                    $qrscene_id=$this->get_eventkey_info($result['eventkey']);
            /*        $Usage = new Usage();
                    $qrscene_id = $Usage->get_eventkey_son_info($result->eventkey);
                    if ($qrscene_id) {
                        foreach ($qrscene_id as $key => $eventkey) {

                            $row2 = DB::table('wx_user_info')
                                ->where('eventkey', $eventkey)
                                ->where('scandate', date('Y-m-d'))
                                ->whereRaw('UNIX_TIMESTAMP(endtime)>=' . strtotime($prevtime))
                                ->get();

                            foreach ($row2 as $send_openid) {
                                $content = new Text();
                                $content->content = "您好，" . $zone->get_zone_name($result->zone_id,'1') . "景区" . $result->show_name . "的演出时间是" . $bbb . "。还没到剧场的话要抓紧了哦。\n如果您不知道剧场位置，<a href='" . $result->location_url . "'>点我</a>\n微信演出时间有时无法及时更新，以景区公示为准。";
                                $app->staff->message($content)->by('1001@u_hengdian')->to($send_openid->wx_openid)->send();
                            }
                        }
                    }

                }
                $prevtime = $bbb;
            }
        }*/
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