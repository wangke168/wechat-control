<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class RedirectController extends Controller
{
    //

    /**
     * type是1，2，3，4，5时，用于宣传部的二维码（给了他们五个活码），链接是https://job.hdymxy.com/redirect?type=1
     * id是直接链接跳转
     * group_id是分组做AB测试
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * 跳转，主要用在宣传部推广的数据统计
     *
     */

    public function index(Request $request)
    {
        $action = $request->input('action');
        $type = $request->input('type');
        $id = $request->input('id');
        $active = $request->input('active');
        $uid = $request->input('uid');
        $openid = $request->input('openid');
        $nativepay = $request->input('nativepay');
        $group_id = $request->input('group_id');

        if ($id == '42' || $id == '41') {
            $url = "http://e.hengdianworld.com/jiadian/index.html?uid=677765785F3031";
        }
        switch ($type) {
            case "activity":       //活动链接跳转
                if ($id) {
                    $ip_address = request()->ip();
                    $this->add_click('page', $id, $ip_address);
                    if ($id == "677") {
                        if ($ip_address == "211.140.151.5") {
                            $url = "https://hdyscwl.qiyukf.com/client?k=762336eee6f3d299d818075a902ebc61&wp=1&robotShuntSwitch=1&robotId=90662";
                        } else {
                            $url = "https://hdyscwl.qiyukf.com/client?k=762336eee6f3d299d818075a902ebc61&wp=1&sid=1838697&robotShuntSwitch=1&robotId=90662";
                        }
                    }
                    else{
                        $url = $this->redirect_url($id, $uid);
                    }
                }
                break;
            case "group":   //分组做AB测试
                if ($group_id) {
                    $result = DB::table('page_transition')
                        ->where('group_id', $group_id)
                        ->inRandomOrder()
                        ->first();
                    if ($uid) {
                        $url = "https://job.hdymxy.com/redirect?type=activity&id=" . $result->id . "&uid=" . $uid;
                    } else {
                        $url = "https://job.hdymxy.com/redirect?type=activity&id=" . $result->id;
                    }
                }
                break;
            case "tcandhotel":
                $ip_address = request()->ip();
                return view('topic.tcandhotel.index');
                break;
            case "hjz":     //直接跳转到门票填写信息页，默认当天，黄金周使用，带date，pro参数和uid(pro=16WR&comedate={{$date}})
                $date = $date = \Carbon\Carbon::today()->toDateString();
                $pro = $request->input('pro');
                $uid = $request->input('uid');
                $url = "http://e.hengdianworld.com/yd_mp_s1.aspx?idno=&pro=" . $pro . "&comedate=" . $date . "&wxnumber=&statparam=&uid=" . $uid . "&wpay=&nativepay=";
                break;

            case "ticket":
                $wxnumber = $request->input('wxnumber');
                $uid = $request->input('uid');
                $wpay = $request->input('wpay');
                $nativepay = $request->input('nativepay');
                $comedate = $request->input('comedate');
                $pro = $request->input('pro');
                break;

            case "tc":     //酒店企业号中套餐预定
                $hotel_id = $request->input("hotel_id");
                if ($hotel_id) {
                    $ip_address = request()->ip();
                    $this->add_click($type, $hotel_id, $ip_address, $openid);
                    //获取酒店真实ID（官网后台的）
                    $result = DB::table('Hotel_ID')
                        ->where('ID', $hotel_id)
                        ->first();
                    $url = $this->redirect_detail($type, $id, $result->Hotel_ID, $uid, $nativepay);
                } else {
                    $url = $this->redirect_detail($type, $id, null, $uid, $nativepay);
                }
                break;
            case "hotel":   //酒店企业号中单订住宿
                $hotel_id = $request->input("hotel_id");
                $ip_address = request()->ip();
                $this->add_click($type, $hotel_id, $ip_address, $openid);
                $result = DB::table('Hotel_ID')
                    ->where('ID', $hotel_id)
                    ->first();
                $url = $this->redirect_detail($type, $id, $result->Hotel_ID, $uid, $nativepay);
                break;
            default:
                break;
        }
        return redirect($url);
    }

    /**
     * 营销推广链接跳转
     * @param $id
     * @param null $uid
     * @return mixed|string
     */
    public function redirect_url($id, $uid = null)
    {
        $result = DB::table('page_transition')
            ->where('id', $id)
            ->first();
        if ($uid) {
            if (strpos($result->url, 'uid') !== false) {
                $url = $result->url;
            } else {
                if (strpos($result->url, '?') !== false) {
                    $url = $result->url . "&uid=" . $uid;
                } else {
                    $url = $result->url . "?uid=" . $uid;
                }
            }
        } else {
            $url = $result->url;
        }
        return $url;
    }

    /**
     * 增加点击数
     * @param $id
     */
    public function add_click($action, $id, $ip_address, $openid = null)
    {

        if ($action == 'page') {
            DB::table('page_transition')
                ->where('id', $id)
                ->increment('count');

            DB::table('page_transition_click_detail')
                ->insert(['url_id' => $id, 'ip_address' => $ip_address, 'addtime' => Carbon::now()]);
        } else {
            DB::table('Hotel_ID')
                ->where('id', $id)
                ->increment('Count');
            DB::table('Hotel_ID_Click_Detail')
                ->insert(['hotel_id' => $id, 'ip_address' => $ip_address, 'type' => $action, 'openid' => $openid, 'addtime' => Carbon::now()]);
        }
    }


    /**
     * 活码跳转
     * @param $type
     * @return string
     */
    public function redirect_qrcode($type)
    {
        $result = DB::table('redirect_info')
            ->orderBy('id', 'asc')
            ->get();
        if ($type > 5) {
            return ('无此二维码');
        } else {
            $i = $type - 1;
            if ($result[$i]->end_date >= Carbon::today()->format('Y - m - d')) {
                return ($result[$i]->redirect_url);
            } else {
                return ($type . '号二维码无对应链接或已过期');
            }
        }
    }

    /**
     * 景区LED屏的门票二维码跳转
     * @param $id
     */
    private function redirect_active($id)
    {
        http://e.hengdianworld.com/yd_mp_s1.aspx?pro=${item}&comedate=${date}&uid=${this.uid[this.getUrlParam('jq')]}
    }


    /**
     * 酒店卖房页面  http://job.hdymxy.com/hotel/order?=1
     * @param $type   hotel:单订住宿   tc：套餐预定
     * @param $id   套餐ID
     * @param null $Hotel_ID 酒店ID    注意是在数据库里的ID，而不是官网中的酒店ID
     * @param null $uid 对应的UID
     * @param int $nativepay 0：自己手机支付    1：出现支付二维码，让对方支付
     * @return string
     */
    private function redirect_detail($type, $id, $Hotel_ID = null, $uid = null, $nativepay = 0)
    {
        $indate = Carbon::today()->toDateString();
        $todate = Carbon::tomorrow()->toDateString();
        $date = Carbon::today()->toDateString();
        if ($type == "tc") {
            $url = "http://e.hengdianworld.com/yd_tc_s1.aspx?id=" . $id . "&comedate=" . $date . "&outdate=&wxnumber=&coupon=&statparam=&wpay=&uid=" . $uid . "&nativepay=" . $nativepay . "&hotelno=" . $Hotel_ID;
        } elseif ($type == "hotel") {
            $url = "http://e.hengdianworld.com/yd_hotel_s1.aspx?indate=" . $indate . "&outdate=" . $todate . "&hotelno=" . $Hotel_ID . "&nativepay=" . $nativepay . "&wxnumber=&coupon=&statparam=&uid=" . $uid . "&wpay=&ismalasong=";
        }
        return $url;
    }

}
