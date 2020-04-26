<?php
namespace Bine\wechat\publics;


use Bine\wechat\config\ApiUrl;
use Illuminate\Support\Facades\Cache;

class Token
{
    use ApiUrl,Property;

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
        return Cache::remember('access_token', $time, function () use ($config) {
            $api_url = static::$uri . "/cgi-bin/token?grant_type=client_credential&appid=" . $config['appID'] . "&secret=" . $config['appsecret'];

            $json = file_get_contents($api_url);

            $result = json_decode($json, true);

            return $result['access_token'];
        });
    }
}
