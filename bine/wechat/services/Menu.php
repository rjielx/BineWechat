<?php
namespace Bine\wechat\services;

use Bine\wechat\publics\Controller;

class Menu extends Controller
{
    /**
     * 创建公众号菜单
     *
     * @param $data
     * @param string $data_type
     * @return mixed
     * @throws \Exception
     */
    public function setMenu($data, $data_type = 'array')
    {
        if (count($data) <= 0) {
            throw new \Exception('菜单不能为空');
        }
        $url = static::$uri . '/cgi-bin/menu/create?access_token=' . $this->getAccessToken;

        if ($data_type == 'array') {
            $data = $this->json_encode_unicode($data);
        }

        $result = $this->ApiRequest('post',$url,$data);
        return $result;
    }


    /**
     * 查询公众号菜单信息
     *
     * @return mixed
     * @throws \Exception
     */
    public function queryMenu()
    {
        $url = static::$uri . '/cgi-bin/get_current_selfmenu_info?access_token=' . $this->getAccessToken;

        $result = $this->ApiRequest('get',$url);
        return $result;
    }


    /**
     * 删除公众号菜单
     *
     * @Author RJie
     * @return mixed
     * @throws \Exception
     */
    public function deleteMenu()
    {
        $url = static::$uri.'/cgi-bin/menu/delete?access_token='.$this->getAccessToken;

        $result = $this->ApiRequest('get',$url);
        return $result;
    }
}
