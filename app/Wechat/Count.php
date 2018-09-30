<?php

namespace App\WeChat;

use DB;

class Count
{

    /**
     * 文章阅读数统计
     * @param $id
     * @return int
     */
    public function count_hits_article($id)
    {
        $row = DB::table('wx_article_hits')
            ->where('article_id', $id)
            ->count();
        return $row;
    }

    /**
     * 文章阅读数统计(不重复点击数)
     * @param $id
     * @return mixed|static
     */
    public function count_hits_norepeat($id)
    {
        $row = DB::table('wx_article_hits')
            ->selectRaw('count(distinct wx_openid) as total')
            ->where('article_id', $id)
            ->first();
        return $row;
    }

    public function check_payed($sellid)
    {
        $row = DB::table('wx_order_send')
            ->where('sellid', $sellid)
            ->first();
        return $row;
    }


    /**
     * 菜单不重复点击数
     * @param $menuid
     * @param $type
     * @param $startdate
     * @param $enddate
     * @return mixed
     */
    public function count_menu_click($menuid, $type, $startdate, $enddate)
    {
        if ($type == 'all') {
            $row = DB::table('wx_click_hits')
                ->where('click', $menuid)
                ->whereDate('adddate', '>=', $startdate)
                ->whereDate('adddate', '<', $enddate)
                ->count();
            return $row;
        } elseif ($type == 'notrepeat') {
            $row = DB::table('wx_click_hits')
                ->selectRaw('count(distinct wx_openid) as total')
                ->where('click', $menuid)
                ->whereDate('adddate', '>=', $startdate)
                ->whereDate('adddate', '<', $enddate)
                ->first();

//            dd($row) ;
            return $row->total;
        }
//        return $row;
    }

    /**
     * 查询单一微信号的菜单点击情况
     * @param $openid
     * @return string
     */
    public function order_menu_click($openid)
    {
        $rows = DB::table('wx_click_hits')
            ->where('wx_openid', $openid)
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();
        $click_info = '';
        if ($rows) {
            foreach ($rows as $row) {
                $click_info = $click_info . '|' . $row->click;
            }
        }
        return $click_info;
    }

    /*
     * 二次推送的数据到达率
     */
    public function se_request_count($id)
    {
        $row = DB::table('se_info_send')
            ->where('info_id', $id)
            ->count();
        return $row;
    }

    /*
     * 二次推送的数据打开率
     */
    public function se_request_read_count($id)
    {
        $row = DB::table('se_info_send')
            ->where('info_id', $id)
            ->where('is_read', '1')
            ->count();
        return $row;
    }

    public function count_market_info($type, $eventkey, $from, $to)
    {
        switch ($type) {

            case "user_add":
                $row = DB::table('wx_user_add')
                    ->where('eventkey', $eventkey)
                    ->whereDate('adddate', '>=', $from)
                    ->whereDate('adddate', '<', $to)
                    ->count();
                break;
            case "user_esc":
                $row = DB::table('wx_user_esc')
                    ->where('eventkey', $eventkey)
                    ->whereDate('esc_time', '>=', $from)
                    ->whereDate('esc_time', '<', $to)
                    ->count();
                break;
            case 'articles':
                $row = DB::table('wx_article')
                    ->where('eventkey', $eventkey)
                    ->whereDate('adddate', '>=', $from)
                    ->whereDate('adddate', '<', $to)
                    ->count();
                break;
            case 'articles_hits':
                $row = DB::table('wx_article')
                    ->where('eventkey', $eventkey)
                    ->whereDate('adddate', '>=', $from)
                    ->whereDate('adddate', '<', $to)
                    ->sum('hits');
                $row==null&&$row='0';
                break;
            case 'articles_resp':
                $row = DB::table('wx_article')
                    ->where('eventkey', $eventkey)
                    ->whereDate('adddate', '>=', $from)
                    ->whereDate('adddate', '<', $to)
                    ->sum('resp');
                $row==null&&$row='0';
                break;
            case 'order':
                $row = DB::table('wx_order_send')
                    ->where('eventkey', $eventkey)
                    ->whereDate('adddate', '>=', $from)
                    ->whereDate('adddate', '<', $to)
                    ->count();
                break;


        }
        return $row;
    }
}