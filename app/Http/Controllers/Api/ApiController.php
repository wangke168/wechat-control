<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\WeChat\Usage;
use Carbon\Carbon;
use EasyWeChat\Foundation\Application;
use App\WeChat\Count;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Intervention\Image\Facades\Image;

class ApiController extends Controller
{
    public $usage;
    public $app;
    public $qrcode;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->qrcode = $this->app->qrcode;
        $this->usage = new Usage();
    }

    /**
     * 输出龙帝惊临临时二维码
     * @return mixed
     */
    public function ldjl()
    {
        $row = DB::table('wx_qrscene_temp_info')
            ->where('qrscene_id', '1306')
            ->first();
        $qr_id = $row->qrscene_id;
        $qr_expire = $row->expireseconds * 60;
        if ($row->qrscene_logo) {
            $qr_logo = $row->qrscene_logo;
        } else {
            $qr_logo = 'qr/logo.png';
        }

        $result = $this->qrcode->temporary($qr_id, $qr_expire);
        $ticket = $result->ticket;// 或者 $result['ticket']

        $QR = $this->qrcode->url($ticket);
        $logo = $qr_logo;
        $img = Image::make($QR);
        $img->insert($logo, 'center');
        return $img->response('png');
    }

    public function api_mobile(Request $request)
    {
        $type = $request->input('type');
        switch ($type) {
            case 'show':
                $show = array();
                $date = Carbon::now()->toDateString();
                $zone = new \App\WeChat\Zone();
                $rows_zone = DB::table('zone')
                    ->orderBy('priority', 'asc')
                    ->get();
                foreach ($rows_zone as $row_zone) {
                    //获取现在所处时间段

                    $rows_show = DB::table('zone_show_time')
                        ->whereDate('startdate', '<=', $date)
                        ->whereDate('enddate', '>=', $date)
                        ->where('zone_id', $row_zone->id)
                        ->orderBy('show_id', 'asc')
                        ->get();
                    if ($rows_show) {
                        $zone_name = $row_zone->zone_name;
                        $show_info = array();
                        foreach ($rows_show as $row_show) {
                            if ($zone->get_correct_show($row_show->id, $row_show->show_id, $date)) {
                                $show_name = $zone->get_project_info($row_show->show_id)->show_name;
                                if ($row_show->se_name) {
                                    $show_name = $row_show->se_name . '(' . $show_name . ')';
                                }

                                $show_time = str_replace(',', ' | ', $row_show->show_time);
                                if ($row_show->remark) {
                                    $show_remark = $row_show->remark;
                                } else {
                                    $show_remark = '';
                                }
                                $show_info[] = array('show_name' => $show_name, 'show_time' => $show_time, 'show_remark' => $show_remark);
                            }
                        }
                    }
                    else{
                        continue;
                    }
                    $show[] = array('zone'=>$zone_name,'info' => $show_info);
                }
         //       $aaa=json_encode($show);
       //         var_dump(json_decode($aaa));
//                return $show;
                     return response()->json($show)->setCallback(request()->input('callback'));
                break;
            case 'showdetail':
                $show = array();
                $date = Carbon::now()->toDateString();
                $zone = new \App\WeChat\Zone();
                $rows_zone = DB::table('zone')
                    ->orderBy('priority', 'asc')
                    ->get();
                foreach ($rows_zone as $row_zone) {
                    //获取现在所处时间段

                    $rows_show = DB::table('zone_show_time')
                        ->where('zone_id', $row_zone->id)
                        ->orderBy('show_id', 'asc')
                        ->get();
                    if ($rows_show) {
                        $zone_name = $row_zone->zone_name;
                        $show_info = array();
                        foreach ($rows_show as $row_show) {
//                            if ($zone->get_correct_show($row_show->id, $row_show->show_id, $date)) {
                                $show_name = $zone->get_project_info($row_show->show_id)->show_name;
                                if ($row_show->se_name) {
                                    $show_name = $row_show->se_name . '(' . $show_name . ')';
                                }

                                $show_time = str_replace(',', ' | ', $row_show->show_time);
                                if ($row_show->remark) {
                                    $show_remark = $row_show->remark;
                                } else {
                                    $show_remark = '';
                                }

                                $show_info[] = array('show_name' => $show_name, 'show_time' => $show_time,'startdate' => $row_show->startdate,'enddate' => $row_show->enddate,  'show_remark' => $show_remark);
                            }
                        }
//                    }
                    else{
                        continue;
                    }
                    $show[] = array('zone'=>$zone_name,'info' => $show_info);
                }
                //       $aaa=json_encode($show);
                //         var_dump(json_decode($aaa));
//                return $show;
                return response()->json($show)->setCallback(request()->input('callback'));
                break;
                break;
            case 'cast':
                $row_day=DB::table('wx_article')
                    ->find('37');
                $day_update=$row_day->adddate;
                $day_cast=$row_day->content;
                $row_week=DB::table('wx_article')
                    ->find('38');
                $week_cast=$row_week->content;
                $week_update=$row_week->adddate;

                $data=['day_update'=>$day_update,'day'=>$day_cast,'week_update'=>$week_update,'week'=>$week_cast];
                return response()->json($data)->setCallback(request()->input('callback'));
                break;
        }
    }

}
