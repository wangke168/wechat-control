<?php
/**
 * Created by PhpStorm.
 * User: wangke
 * Date: 16/12/16
 * Time: 上午10:07
 */

namespace App\WeChat;

use DB;

class Menu_Select
{

    public function zone_list($id=null)
    {
        if (!$id)
        {
            $rows = DB::table('zone')
                ->get();
            echo "<option>";
            foreach ($rows as $row) {
                echo "<option value=\"" . $row->id . "\">" . $row->zone_name . "</option>";
            }
            echo "</option>";
        }
        else{
            $rows = DB::table('zone')
                ->get();
            echo "<option>";
            foreach ($rows as $row) {
                if ($id == $row->id) {
                    echo "<option selected value=\"" . $row->id . "\">" . $row->zone_name . "</option>";
                }
                else{
                    echo "<option value=\"" . $row->id . "\">" . $row->zone_name . "</option>";
                }
            }
            echo "</option>";
        }
    }

    /**
     * 演艺秀推送设置中的下拉菜单(选择演艺秀)
     * @param null $id
     */
    public function show_list($id = null)
    {
        if (!$id) {
            $rows = DB::table('zone')
                ->get();
            foreach ($rows as $row) {
                echo "<optgroup label=\"" . $row->zone_name . "\">";
                $result_options = DB::table('zone_show_info')
//                    ->whereRaw('id not in (select project_id from zone_show_time)')
                    ->where('zone_id', $row->id)
                    ->get();
                foreach ($result_options as $result_option) {
                    echo "<option value=\"" . $result_option->id . "\">" . $result_option->show_name . "</option>";
                }

                echo "</optgroup>";
            }
        } else {

            $rows = DB::table('zone')
                ->get();
            foreach ($rows as $row) {
                echo "<optgroup label=\"" . $row->zone_name . "\">";

                $result_options = DB::table('zone_show_info')
                    ->where('zone_id', $row->id)
                    ->get();
                foreach ($result_options as $result_option) {
                    if ($id == $result_option->id) {
                        echo "<option selected  value=\"" . $result_option->id . "\">" . $result_option->show_name . "</option>";
                    } else {
                        echo "<option  value=\"" . $result_option->id . "\">" . $result_option->show_name . "</option>";
                    }
                }
                echo "</optgroup>";
            }
        }
    }
}