<?php
namespace Bine\wechat\config;

use GuzzleHttp\Client;

trait ApiUrl
{
    /**
     * 网页授权code请求域名
     * @var string
     */
    public static $codeUri = 'https://open.weixin.qq.com';

    /**
     * 通用域名
     * 使用该域名将访问官方指定就近的接入点
     * @var string
     */
    public static $uri = 'https://api.weixin.qq.com';

    /**
     * 通用异地容灾域名
     * 当上述域名不可访问时可改访问此域名
     * @var string
     */
    public static $uri2 = 'https://api2.weixin.qq.com';

    /**
     * 上海域名
     * 使用该域名将访问上海的接入点
     * @var string
     */
    public static $sh_uri = 'https://sh.api.weixin.qq.com';

    /**
     * 深圳域名
     * 使用该域名将访问深圳的接入点
     * @var string
     */
    public static $sz_uri = 'https://sz.api.weixin.qq.com';

    /**
     * 香港域名
     * 使用该域名将访问香港的接入点
     * @var string
     */
    public static $hk_uri = 'https://hk.api.weixin.qq.com';


    /**
     * @Author RJie
     * @param string $method
     * @param $uri
     * @param array $params
     * @param string $body
     * @return mixed
     * @throws \Exception
     */
    public function ApiRequest($method = 'get',$uri,$params = [],$body = 'form_params')
    {
        $client = new Client();

        if($method == 'get') {
            $body = 'query';
        }

        if($params){
            $respond = $client->request($method, $uri,[$body => $params]);
        }else{
            $respond = $client->request($method, $uri);
        }


        if ($respond->getStatusCode() === 200) {
            $result = json_decode($respond->getBody()->getContents(), true);

            return $result;
        } else {
            throw new \Exception('请求失败');
        }
    }

    /**
     * @Author RJie
     * @param $url
     * @param $data
     * @return bool|string
     */
    public function curl_post($url,$data)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
        $output = json_decode($output,true);
        return ['exec' => $output,'error' => $error];
    }
}
