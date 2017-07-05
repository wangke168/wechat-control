<?php
/**
 * Created by PhpStorm.
 * User: wangke
 * Date: 17/2/28
 * Time: 上午10:39
 */

namespace App\WeChat;


class Api
{
    /**
     * 获取wechat的token和ticket
     * @return mixed|string
     */
    public function get_wechat_api()
    {
        /*$token_url = "https://wechat.hdymxy.com/api";
        $result = file_get_contents($token_url);
        $result = json_decode($result, true);
        return $result;*/
        $token_url = "https://wechat.hdymxy.com/api";
//        $ACCESS_TOKEN = file_get_contents($token_url);
//        return $ACCESS_TOKEN;
        $result =  $this->getSslPage($token_url);
        $result = json_decode($result, true);
        return $result;
    }

    private function getSslPage($url) {
        /*  http://www.manongjc.com/article/1428.html */
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

}