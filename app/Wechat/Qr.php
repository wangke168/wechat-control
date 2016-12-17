<?php
namespace App\WeChat;

use DB;

class Qr
{
    /**
     * 获取二维码的类别展示下拉框
     */
    public function get_qr_classid()
    {
        $rows = DB::table('wx_qrscene_class')
            ->get();
        foreach ($rows as $row) {
            echo "<option value=\"" . $row->classid . "\">" . $row->class_name . "</option>";
        }
    }

    /**
     * 获取二维码所属类别并在修改页面
     * @param $classid
     */
    public function check_qr_classid($classid)
    {
        $rows = DB::table('wx_qrscene_class')
            ->get();
        foreach ($rows as $row) {
            if ($row->classid == $classid) {
                echo "<option selected value=\"" . $row->classid . "\">" . $row->class_name . "</option>";
            } else {
                echo "<option value=\"" . $row->classid . "\">" . $row->class_name . "</option>";
            }
        }
    }

}