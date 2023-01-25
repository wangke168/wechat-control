<?php
/**
 * Created by PhpStorm.
 * User: thinpig
 * Date: 2022/6/11
 * Time: 15:06
 */

namespace App\WeChat;


class getMiniProgramAccessToken
{

    const API_TOKEN_GET = 'https://api.weixin.qq.com/cgi-bin/token';

    public function getToken($forceRefresh = false)
    {
           $cacheKey = $this->getCacheKey();
           $cached = $this->getCache()->fetch($cacheKey);

           if ($forceRefresh || empty($cached)) {
               $token = $this->getTokenFromServer();

               // XXX: T_T... 7200 - 1500
               $this->getCache()->save($cacheKey, $token[$this->tokenJsonKey], $token['expires_in'] - 1500);

               return $token[$this->tokenJsonKey];
           }

           return $cached;

    }

    public function getTokenFromServer()
    {
        $params = [
            'appid' => 'wxb5d796707f1b810a',
            'secret' => 'fe4c201a28b21f483fcf450b6154521a',
            'grant_type' => 'client_credential',
        ];

        $http = $this->getHttp();

        $token = $http->parseJSON($http->get(self::API_TOKEN_GET, $params));

        if (empty($token['access_token'])) {
            throw new HttpException('Request AccessToken fail. response: ' . json_encode($token, JSON_UNESCAPED_UNICODE));
        }

        return $token;
    }

    public function getCacheKey()
    {
        if (is_null($this->cacheKey)) {
            return $this->prefix . $this->appId;
        }

        return $this->cacheKey;
    }

    public function getCache()
    {
        return $this->cache ?: $this->cache = new FilesystemCache(sys_get_temp_dir());
    }
}
