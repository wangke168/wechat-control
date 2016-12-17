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



}