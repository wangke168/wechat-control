<?php

namespace App\WeChat;
use DB;

class Count
{

    public function count_hits_norepeat($id)
    {
        $row=DB::table('wx_article_hits')
            ->selectRaw('count(distinct wx_openid) as total')
            ->where('article_id',$id)
            ->first();
        return $row;
    }

    public function check_payed($sellid)
    {
        $row=DB::table('wx_order_send')
            ->where('sellid',$sellid)
            ->first();
        return $row;
    }

    /*
     * 查询点击的菜单情况
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
}