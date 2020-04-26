<?php
namespace Bine\wechat\services;

use Bine\wechat\publics\Controller;
use Illuminate\Support\Facades\Cache;

class JsapiJSSDK extends Controller
{
    /**
     * JS-SDK验证
     *
     * @return mixed
     */
    public function ticket()
    {
        $access_token = $this->getAccessToken;
        $time = now()->addSeconds(7200);
        return Cache::remember('ticket', $time, function () use ($access_token) {
            $uri = static::$uri . '/cgi-bin/ticket/getticket?access_token=' . $access_token . '&type=jsapi';
            $json = file_get_contents($uri);
            $result = json_decode($json, true);

            return $result['ticket'];
        });
    }

    /**
     * JS-SDK签名重构
     *
     * @param $params
     * @return string
     */
    private function ticketAutograph($params)
    {
        $ticket = $this->ticket();
        $data = [
            'jsapi_ticket' => $ticket,
            'noncestr' => $params['noncestr'],
            'timestamp' => $params['time'],
            'url' => $params['url'],
        ];

        $params = '';
        foreach ($data as $key => $value) {
            $params .= '&' . $key . '=' . $value;
        }
        $params = trim($params, '&');

        return $params;
    }

    /**
     * 生成随机字符串
     *
     * @return bool|string
     */
    private function randomStr()
    {
        $strs = "QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm";
        $name = substr(str_shuffle($strs), mt_rand(0, strlen($strs) - 11), 16);
        return $name;
    }

    /**
     * 初始JS-SDK配置参数
     *
     * @param $url 当前网页的URL，不包含#及其后面部分
     * @param array $jsApiList
     * @return false|string
     */
    public function initWXJSInterface($url, $jsApiList = [])
    {
        $noncestr = $this->randomStr();
        $time = time();

        $params = [
            'noncestr' => $noncestr,
            'time' => $time,
            'url' => $url
        ];

        $autograph = $this->ticketAutograph($params);
        $autograph = sha1($autograph);  // 生成签名

        return json_encode([
            'appId' => $this->config['appID'],
            'timestamp' => $time,
            'nonceStr' => $noncestr,
            'signature' => $autograph,
            'jsApiList' => $jsApiList,
        ]);
    }
}
