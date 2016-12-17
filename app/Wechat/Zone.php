<?php
/**
 * Created by PhpStorm.
 * User: wangke
 * Date: 16/12/16
 * Time: 上午10:08
 */

namespace App\WeChat;

use DB;
class Zone
{
    /**
     * 获取演艺秀名称
     * @param $project_id
     * @return mixed|static
     */
    public function get_project_info($project_id)
    {
        $row=DB::table('tour_project_class')
            ->where('id',$project_id)
            ->first();
        return $row;
    }

    public function get_zone_info($zone_id)
    {
        $row=DB::table('tour_zone_class')
            ->where('id',$zone_id)
            ->first();
        return $row;
    }
}