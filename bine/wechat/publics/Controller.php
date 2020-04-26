<?php

namespace Bine\wechat\publics;

use Bine\wechat\config\ApiUrl;
use GuzzleHttp\Client;

class Controller
{
    use ApiUrl, Property;

    /**
     * Controller constructor.
     * @param array $config
     */
    public function __construct($config = array())
    {
        $this->client = new Client();

        $this->config = $config;
        $this->token = new Token($config);

        $this->getAccessToken = $this->token->getAccessToken();
    }


    /**
     * 请求方法
     *
     * @Author RJie
     * @param string $method
     * @param $uri
     * @param array $params
     * @return mixed
     * @throws \Exception
     */
    public function ApiRequest($method = 'get', $uri, $params = [])
    {
        if ($method == 'get') {
            $respond = $this->client->request($method, $uri);
        } else {
            $respond = $this->client->request('post', $uri, ['form_params' => $params]);
        }
        try {
            if ($respond->getStatusCode() === 200) {
                $result = json_decode($respond->getBody()->getContents(), true);

                return $result;
            } else {
                throw new \Exception('请求失败');
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
