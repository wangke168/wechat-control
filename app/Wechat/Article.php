<?php
/**
 * Created by PhpStorm.
 * User: wangke
 * Date: 16/12/16
 * Time: 上午10:01
 */

namespace App\WeChat;

use DB;

class Article
{
    /*
       * 添加文章时选择栏目
       */
    public function menuList()
    {
        $rows = DB::table('wx_menu_list')
            ->where('online', '1')
            ->where('parents_id', '0')
            ->orderBy('priority', 'asc')
            ->get();
        foreach ($rows as $row) {

            $result_options = DB::table('wx_menu_list')
                ->where('online', '1')
                ->where('parents_id', $row->id)
                ->orderBy('priority', 'asc')
                ->get();
//                    $result_option = mysql_query("select * from wx_menu_list where online='1' and parents_id='" . $row["ID"] . "' order by id asc");

            if ($result_options) {
                echo "<optgroup label=\"" . $row->menu_name . "\">";
                foreach ($result_options as $result_option) {

                    echo "<option value=\"" . $result_option->id . "\">" . $result_option->menu_name . "</option>";

                }
                echo "</optgroup>";
            } else {
                echo "<option value=\"" . $row->id . "\">" . $row->menu_name . "</option>";
            }


        }
    }

    /*
     * 编辑文章时确认所选栏目
     */
    public function menuCheck($classid)
    {
        $rows = DB::table('wx_menu_list')
            ->where('online', '1')
            ->where('parents_id', '0')
            ->orderBy('priority', 'asc')
            ->get();
        foreach ($rows as $row) {
            $result_options = DB::table('wx_menu_list')
                ->where('online', '1')
                ->where('parents_id', $row->id)
                ->orderBy('priority', 'asc')
                ->get();
            if ($result_options) {
                echo "<optgroup label=\"" . $row->menu_name . "\">";
                foreach ($result_options as $result_option) {
                    if ($classid == $result_option->id) {
                        echo "<option selected  value=\"" . $result_option->id . "\">" . $result_option->menu_name . "</option>";
                    } else {
                        echo "<option  value=\"" . $result_option->id . "\">" . $result_option->menu_name . "</option>";
                    }
                }
                echo "</optgroup>";
            } else {
                if ($classid == $row->id) {
                    echo "<option selected  value=\"" . $row->id . "\">" . $row->menu_name . "</option>";
                } else {
                    echo "<option  value=\"" . $row->id . "\">" . $row->menu_name . "</option>";
                }
            }
        }
    }
}