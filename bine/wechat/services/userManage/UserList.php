<?php
namespace Bine\wechat\services\userManage;

use Bine\wechat\interfaces\UserListInterface;
use Bine\wechat\publics\Controller;

class UserList extends Controller implements UserListInterface
{
    /**
     * 获取用户列表
     *
     * @Author RJie
     * @param string $next_openid
     * @return mixed
     * @throws \Exception
     */
    public function userGet($next_openid = '')
    {
        $url = static::$uri.'/cgi-bin/user/get?access_token='.$this->getAccessToken.'&next_openid='.$next_openid;

        $result = $this->ApiRequest('get',$url);
        return $result;
    }


    /**
     * 设置用户备注名
     *
     * @Author RJie
     * @param $openid
     * @param $remark
     * @return mixed
     * @throws \Exception
     */
    public function updateRemark($openid,$remark)
    {
        $url = static::$uri . '/cgi-bin/user/info/updateremark?access_token='.$this->getAccessToken;

        $data = [
            'openid' => $openid,
            'remark' => $remark,
        ];

        $result = $this->ApiRequest('post', $url, $data, 'json');
        return $result;
    }
}
