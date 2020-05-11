<?php

namespace Bine\wechat\services\userManage;

use Bine\wechat\publics\Controller;

class Blacklist extends Controller
{
    /**
     * 获取公众号的黑名单列表
     *
     * @Author RJie
     * @param $begin_openid
     * @return mixed
     * @throws \Exception
     */
    public function getBlacklist($begin_openid)
    {
        $url = static::$uri . '/cgi-bin/tags/members/getblacklist?access_token=' . $this->getAccessToken;

        $data = [
            'begin_openid' => $begin_openid
        ];

        $result = $this->ApiRequest('post', $url, $data, 'json');
        return $result;
    }


    /**
     * 拉黑用户
     *
     * @Author RJie
     * @param array $openid_list
     * @return mixed
     * @throws \Exception
     */
    public function batchBlacklist(array $openid_list)
    {
        $url = static::$uri . '/cgi-bin/tags/members/batchblacklist?access_token=' . $this->getAccessToken;

        $data = [
            'openid_list' => $openid_list
        ];

        $result = $this->ApiRequest('post', $url, $data, 'json');
        return $result;
    }


    /**
     * 取消拉黑用户
     *
     * @Author RJie
     * @param array $openid_list
     * @return mixed
     * @throws \Exception
     */
    public function batchUnBlacklist(array $openid_list)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/tags/members/batchunblacklist?access_token='.$this->getAccessToken;

        $data = [
            'openid_list' => $openid_list
        ];

        $result = $this->ApiRequest('post', $url, $data, 'json');
        return $result;
    }
}

