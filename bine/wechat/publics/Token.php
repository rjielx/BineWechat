<?php

namespace Bine\wechat\publics;


use Bine\wechat\config\ApiUrl;
use Bine\wechat\interfaces\TokenInterface;
use Illuminate\Support\Facades\Cache;

class Token implements TokenInterface
{
    use ApiUrl, Property;

    public function __construct($config = array())
    {
        $this->config = $config;
    }

    /**
     * 获取微信公众号access_token
     *
     * @return mixed
     */
    public function getAccessToken()
    {
        $config = $this->config;
        $time = now()->addSeconds(7200);
        return Cache::remember('access_token_' . $config['appID'], $time, function () use ($config) {
            $api_url = static::$uri . "/cgi-bin/token?grant_type=client_credential&appid=" . $config['appID'] . "&secret=" . $config['appsecret'];

            $json = file_get_contents($api_url);
            $result = json_decode($json, true);
            return $result['access_token'];
        });
    }


    /**
     * 获取微信callback IP地址
     *
     * @return mixed
     * @throws \Exception
     */
    public function callbackIP()
    {
        $url = static::$uri . '/cgi-bin/getcallbackip?access_token=' . $this->getAccessToken();
        $result = $this->ApiRequest('get', $url);
        return $result;
    }
}
