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
        $token_url = "http://localhost:8080/api";
        $result = file_get_contents($token_url);
        $result = json_decode($result, true);
        return $result;

    }
}