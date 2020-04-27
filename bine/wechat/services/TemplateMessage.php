<?php

namespace Bine\wechat\services;


use Bine\wechat\interfaces\TemplateMessageInterface;
use Bine\wechat\publics\Controller;

class TemplateMessage extends Controller implements TemplateMessageInterface
{

    /**
     * 获取设置的行业信息
     *
     * @Author RJie
     * @return mixed
     * @throws \Exception
     */
    public function getIndustry()
    {
        $url = static::$uri . '/cgi-bin/template/get_industry?access_token=' . $this->getAccessToken;
        $result = $this->ApiRequest('get', $url);
        return $result;
    }


    /**
     * 设置所属行业
     *
     * @Author RJie
     * @param $industry_id1
     * @param $industry_id2
     * @return mixed
     * @throws \Exception
     */
    public function setIndustry($industry_id1, $industry_id2)
    {
        $url = static::$uri . '/cgi-bin/template/api_set_industry?access_token=' . $this->getAccessToken;

        $params = [
            'industry_id1' => $industry_id1,
            'industry_id2' => $industry_id2
        ];

        $result = $this->ApiRequest('post', $url, $params);
        return $result;
    }


    /**
     * 查询所有模板信息
     *
     * @Author RJie
     * @return mixed
     * @throws \Exception
     */
    public function getAllPrivateTemplate()
    {
        $url = static::$uri . '/cgi-bin/template/get_all_private_template?access_token=' . $this->getAccessToken;
        $result = $this->ApiRequest('get', $url);
        return $result;
    }


    /**
     * 删除模板
     *
     * @Author RJie
     * @param $template_id 模板ID
     * @return mixed
     * @throws \Exception
     */
    public function delPrivateTemplate($template_id)
    {
        $url = static::$uri . 'https://api.weixin.qq.com/cgi-bin/template/del_private_template?access_token=' . $this->getAccessToken;

        $params = [
            'template_id' => $template_id
        ];

        $result = $this->ApiRequest('post', $url, $params);
        return $result;
    }

    /**
     * 发送模板消息
     *
     * @Author RJie
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function sendTemplateMessage(array $data)
    {
        $url = static::$uri . '/cgi-bin/message/template/send?access_token=' . $this->getAccessToken;

        $result = $this->ApiRequest('post',$url,$data,'json');
        return $result;
    }
}
