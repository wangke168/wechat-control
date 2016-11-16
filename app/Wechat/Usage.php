<?php
/**
 * Created by PhpStorm.
 * User: wangke
 * Date: 16/11/14
 * Time: 上午10:24
 */

namespace App\WeChat;

use DB;

class Usage
{
    public function menuList()
    {
        $rows = DB::table('wx_menu_list')
            ->where('online', '1')
            ->where('parents_id', '0')
            ->orderBy('priority', 'asc')
            ->get();
        foreach ($rows as $row) {
            echo "<optgroup label=\"" . $row->menu_name . "\">";


            $result_options = DB::table('wx_menu_list')
                ->where('online', '1')
                ->where('parents_id', $row->id)
                ->orderBy('priority', 'asc')
                ->get();
//                    $result_option = mysql_query("select * from wx_menu_list where online='1' and parents_id='" . $row["ID"] . "' order by id asc");

            foreach ($result_options as $result_option) {

                echo "<option value=\"" . $result_option->id . "\">" . $result_option->menu_name . "</option>";

            }

            echo "</optgroup>";
        }
    }

    public function menuCheck($classid)
    {
        $rows = DB::table('wx_menu_list')
            ->where('online', '1')
            ->where('parents_id', '0')
            ->orderBy('priority', 'asc')
            ->get();
        foreach ($rows as $row) {
            echo "<optgroup label=\"" . $row->menu_name . "\">";


            $result_options = DB::table('wx_menu_list')
                ->where('online', '1')
                ->where('parents_id', $row->id)
                ->orderBy('priority', 'asc')
                ->get();
//                    $result_option = mysql_query("select * from wx_menu_list where online='1' and parents_id='" . $row["ID"] . "' order by id asc");

            foreach ($result_options as $result_option) {
                if ($classid == $result_option->id) {
                    echo "<option selected  value=\"" . $result_option->id . "\">" . $result_option->menu_name . "</option>";
                } else {
                    echo "<option  value=\"" . $result_option->id . "\">" . $result_option->menu_name . "</option>";
                }
            }

            echo "</optgroup>";
        }
    }

    public function getArticleShowQrsecne($eventkeys)
    {
        $eventkey = explode(',', $eventkeys);
        $qrscenename = '';
        for ($index = 0; $index < count($eventkey); $index++) {
            if ($index == 0) {
                if ($eventkey[$index] == 'all') {
                    $qrscenename = '全部显示';
                } else {
                    $qrscenename = $this->getQrsecneinfo($eventkey[$index]);
                }
            } else {
                if ($eventkey[$index] == 'all') {
                    $qrscenename = $qrscenename . ',全部显示';
                } else {
                    $qrscenename = $qrscenename . ',' . $this->getQrsecneinfo($eventkey[$index])->qrscene_name;
                }
            }
        }
        return $qrscenename;
    }

    public function getQrsecneinfo($eventkey)
    {
        $row = DB::table('wx_qrscene_info')
            ->where('qrscene_id', $eventkey)
            ->first();
        return $row;
    }
}