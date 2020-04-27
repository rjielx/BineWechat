<?php
namespace Bine\wechat\services;

use Bine\wechat\interfaces\WebpageInterface;
use Bine\wechat\publics\Controller;

class Webpage extends Controller implements WebpageInterface
{
    /**
     * 网页授权，用户同意获取code的路径
     *
     * @Author RJie
     * @param $params
     * @return string
     */
    public function getCodeUri($params)
    {
        $redirect_uri = $params['redirect_uri'];
        $scope = $params['scope'] ?? 'snsapi_base';
        $state = $params['state'] ?? 'STATE';

        $api_url = static::$codeUri . '/connect/oauth2/authorize?appid=' . $this->config['appID'] . '&redirect_uri=' . urlencode($redirect_uri) . '&response_type=code&scope=' . $scope . '&state=' . $state . '&connect_redirect=1#wechat_redirect';

        return $api_url;
    }

    /**
     * 网页授权，用户同意获取code
     *
     * @Author RJie
     * @param $params
     */
    public function getCode($params)
    {
        $api_url = $this->getCodeUri($params);
        header('Location:' . $api_url);
    }

    /**
     * 网页授权，通过code换取网页授权access_token
     *
     * @param $code
     * @return mixed
     * @throws \Exception
     */
    public function getCodeToken($code)
    {
        if ($code) {
            $url = static::$uri . '/sns/oauth2/access_token?';
            $url = $url . 'appid=' . $this->config['appID'];
            $url = $url . '&secret=' . $this->config['appsecret'];
            $url = $url . '&code=' . $code;
            $url = $url . '&grant_type=authorization_code';

            $result = $this->ApiRequest('get',$url);
            return $result;
        } else {
            throw new \Exception('code为空');
        }
    }


    /**
     * 网页授权,刷新CodeToken
     *
     * @param $refresh_token
     * @return mixed
     * @throws \Exception
     */
    public function refreshCodeToken($refresh_token)
    {
        if ($refresh_token) {

            $url = static::$uri . '/sns/oauth2/refresh_token?appid=' . $this->config['appID'] . '&refresh_token=' . $refresh_token . '&grant_type=refresh_token';

            $result = $this->ApiRequest('get',$url);
            return $result;
        } else {
            throw new \Exception('refresh_token不能为空');
        }
    }

    /**
     * 网页授权，获取用户微信信息
     *
     * @Author RJie
     * @param $openId
     * @return mixed
     * @throws \Exception
     */
    public function getOpenInfo($openId)
    {
        $url = static::$uri . '/cgi-bin/user/info?access_token=' . $this->getAccessToken . '&openid=' . $openId . '&lang=zh_CN';
        $result = $this->ApiRequest('get',$url);
        return $result;
    }
}
