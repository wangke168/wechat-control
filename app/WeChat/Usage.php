<?php
/**
 * Created by PhpStorm.
 * User: wangke
 * Date: 16/11/14
 * Time: 上午10:24
 */

namespace App\WeChat;

use DB;
use Image;
class Usage
{
    /**
     * 根据eventkey获取对应名称
     * @param $eventkeys
     * @return string
     */
    public function getArticleShowQrsecne($eventkeys)
    {
        $eventkey = explode(',', $eventkeys);
        $qrscenename = '';
        for ($index = 0; $index < count($eventkey); $index++) {
            if ($index == 0) {
                if ($eventkey[$index] == 'all') {
                    $qrscenename = '全部显示';
                } else {
                    $qrscenename = $this->getQrsecneinfo($eventkey[$index])->qrscene_name;
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

    /**
     * 根据市场名称获取eventkey
     * @param $qrscene_name
     * @return string
     */
    public function getQrscene_info($qrscene_name)
    {

        $qrscene_name = explode(',', $qrscene_name);
        $marketid = '';
        for ($index = 0; $index < count($qrscene_name); $index++) {
            if ($index == 0) {
                if ($qrscene_name[$index] == '全部显示') {
                    $marketid = "all";
                } else {
                    $row = DB::table('wx_qrscene_info')
                        ->where('qrscene_name', $qrscene_name[$index])
                        ->first();
                    if ($row){
                        $marketid = $row->qrscene_id;
                    }
                }
            } else {
                if ($qrscene_name[$index] == '全部显示') {
                    $marketid = $marketid . ',' . "all";
                } else {
                    $row = DB::table('wx_qrscene_info')
                        ->where('qrscene_name', $qrscene_name[$index])
                        ->first();
                    $marketid = $marketid . ',' . $row->qrscene_id;
                }
            }

        }
        return $marketid;
    }

    /**
     * 获取eventkey对应的信息
     * @param $eventkey
     * @return mixed|static
     */
    public function getQrsecneinfo($eventkey)
    {
        $row = DB::table('wx_qrscene_info')
            ->where('qrscene_id', $eventkey)
            ->first();
        return $row;
    }


    /**
     * 根据二维码的classid获取信息(带参二维码的类别)
     * @param $classid
     * @return mixed|static
     */
    public function get_qr_classid_name($classid)
    {
        $row=DB::table('wx_qrscene_class')
            ->where('classid',$classid)
            ->first();
        return $row;
    }

    /**
     * 获取菜单列表
     * @param $name
     * @param $type
     * @return mixed|string|static
     */
    public function get_menu_info($name,$type)
    {
        switch ($type){
            case 'name':
                $row=DB::table('wx_menu_list')
                    ->where('id',$name)
                    ->first();
                break;
            case 'classid':
                $row=DB::table('wx_menu_list')
                    ->where('menu_name',$name)
                    ->first();
                break;
            default:
                $row='type error';
                break;
        }
        return $row;
    }

    /**
     * 根据tag_id获取eventkey
     * @param $tag_id
     * @return mixed|static
     */
    public function get_tag_info($tag_id)
    {
        $row=DB::table('wx_user_tag')
            ->where('tag_id',$tag_id)
            ->first();
        return $row;
    }

    /**
     * 获取用户的相关信息(昵称,头像等)
     * @param $openId
     * @return mixed
     */
    public function get_openid_info($openId)
    {
        $wechat = app('wechat');
        $userService = $wechat->user;
        $user = $userService->get($openId);
        return $user;

    }

    public function uploadImage($filename, $type)
    {
        if ($filename) {
            $file = $filename;
            //判断文件上传过程中是否出错
            if (!$file->isValid()) {
                exit('文件上传出错！');
            }
            $destPath = 'uploads/' . date('Ymd') . '/';
            if (!file_exists($destPath))
                mkdir($destPath, 0755, true);
            $extension = $file->getClientOriginalExtension();
            $filename = time() . str_random(5) . '.' . $extension;

//            $filename = time() . str_random(5) . $file->getClientOriginalName();
            if (!$file->move($destPath, $filename)) {
                exit('保存文件失败！');
            }

            switch ($type) {

                case 'pic_url':
                    Image::make($destPath . $filename)->save();
                    break;
                case 'pyq_pic':
                    Image::make($destPath . $filename)->fit(200)->save();
                    break;
                case 'qr_logo':
                    Image::make($destPath . $filename)->fit(98)->save();
                    break;
            }

            return $destPath . $filename;

        }
    }

    public function GetCardInfo($str)
    {
        $i = 0;
        $j = 0;
        $k = 0;
        $result = explode("+", $str);
        foreach($result as $value){
            if (strpos($value, '成人') !== false) {
                $i=$this->GetNumbers($value);
            }
            if (strpos($value, '学生') !== false) {
                $k=$this->GetNumbers($value);
            }
            if (strpos($value, '老人') !== false) {
                $j=$this->GetNumbers($value);
            }
        }
        $aaa=array($i,$j,$k);
        return($aaa);
    }

    private function GetNumbers($str)
    {
        $result = '';
        for ($x = 0; $x < strlen($str); $x++) {
            if (is_numeric($str[$x])) {
                $result .= $str[$x];
            }

        }
        return $result;
    }

}