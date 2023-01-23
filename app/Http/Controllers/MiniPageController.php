<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
//use App\WeChat\getMiniProgramAccessToken;
use App\WeChat\Api;
use Doctrine\Common\Cache\Cache;
use Doctrine\Common\Cache\FilesystemCache;
use EasyWeChat\Core\Exceptions\HttpException;
class MiniPageController extends Controller
{
    //
  /*  public function gettoken()
    {
        $getAccessToken = new getMiniProgramAccessToken();
        return $getAccessToken->getToken();
    }*/
    /**
     * App ID.
     *
     * @var string
     */
    protected $appId;

    /**
     * App secret.
     *
     * @var string
     */
    protected $secret;

    /**
     * Cache.
     *
     * @var Cache
     */
    protected $cache;

    /**
     * Cache Key.
     *
     * @var cacheKey
     */
    protected $cacheKey;

    /**
     * Http instance.
     *
     * @var Http
     */
    protected $http;

    /**
     * Query name.
     *
     * @var string
     */
    protected $queryName = 'access_token';

    const API_TOKEN_GET = 'https://api.weixin.qq.com/cgi-bin/token';

    protected $prefix = 'easywechat.minipage.access_token.';


    public function getminipageurl()
    {
        $fields = [
            "path" => "/pages/publishHomework/publishHomework",
            "query" => "",
            "expire_type" => 1,
            "expire_interval" => 1,
            "env_version" => "release",
            "cloud_base" => [
                [
                    "env" => "xxx",
                    "domain" => "xxx.xx",
                    "path" => "/jump-wxa.html",
                    "query" => "a=1&b=2"
                ],
            ],
            /*  'name' => 'Wayne',
              'id' => 2,*/
        ];
        $postdata = http_build_query($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, ' https://api.weixin.qq.com/wxa/generate_urllink?access_token=' . $this->gettoken());
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        echo $result;
    }




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
    /**
     * Return the http instance.
     *
     * @return \EasyWeChat\Core\Http
     */
    public function getHttp()
    {
        return $this->http ?: $this->http = new Http();
    }

    /**
     * Set the http instance.
     *
     * @param \EasyWeChat\Core\Http $http
     *
     * @return $this
     */
    public function setHttp(Http $http)
    {
        $this->http = $http;

        return $this;
    }

    /**
     * Set access token cache key.
     *
     * @param string $cacheKey
     *
     * @return $this
     */
    public function setCacheKey($cacheKey)
    {
        $this->cacheKey = $cacheKey;

        return $this;
    }

    /**
     * Get access token cache key.
     *
     * @return string $this->cacheKey
     */
    public function getCacheKey()
    {
        if (is_null($this->cacheKey)) {
            return $this->prefix.$this->appId;
        }

        return $this->cacheKey;
    }
    public function getCache()
    {
        return $this->cache ?: $this->cache = new FilesystemCache(sys_get_temp_dir());
    }

}
