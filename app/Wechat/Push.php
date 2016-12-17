<?php
/**
 * Created by PhpStorm.
 * User: wangke
 * Date: 16/12/16
 * Time: 上午10:07
 */

namespace App\WeChat;

use DB;
class Push
{
    public function showMenuList($id=null)
    {
        if (!$id) {
            $rows = DB::table('tour_zone_class')
                ->get();
            foreach ($rows as $row) {
                echo "<optgroup label=\"" . $row->zone_name . "\">";

                $result_options = DB::table('tour_project_class')
                    ->whereRaw('id not in (select project_id from tour_project_info)')
                    ->where('zone_classid', $row->id)
                    ->get();
//                    $result_option = mysql_query("select * from wx_menu_list where online='1' and parents_id='" . $row["ID"] . "' order by id asc");

                foreach ($result_options as $result_option) {

                    echo "<option value=\"" . $result_option->id . "\">" . $result_option->project_name . "</option>";

                }

                echo "</optgroup>";
            }
        }
        else{
            $rows = DB::table('tour_zone_class')
                ->get();
            foreach ($rows as $row) {
                echo "<optgroup label=\"" . $row->zone_name . "\">";

                $result_options = DB::table('tour_project_info')
                    ->where('zone_id', $row->id)
                    ->get();
//                    $result_option = mysql_query("select * from wx_menu_list where online='1' and parents_id='" . $row["ID"] . "' order by id asc");

                foreach ($result_options as $result_option) {

//                    echo "<option value=\"" . $result_option->id . "\">" . $result_option->project_name . "</option>";

                    if ($id == $result_option->id) {
                        echo "<option selected  value=\"" . $result_option->id . "\">" . $result_option->show_name . "</option>";
                    } else {
                        echo "<option  value=\"" . $result_option->id . "\">" . $result_option->show_name . "</option>";
                    }
                }

                echo "</optgroup>";
            }
        }
    }}