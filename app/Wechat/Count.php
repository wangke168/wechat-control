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
}