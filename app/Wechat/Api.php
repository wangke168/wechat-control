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
//        $url = "http://localhost:8080/api";
//        $url = "https://wechat.hdymxy.com/api";
        $url=env('API_URL','');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT,60);  //只需要设置一个秒的数量就可以
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);
//        var_dump(curl_error($ch));
        curl_close($ch);
        $result = json_decode($result, true);
        return $result;
    }

}