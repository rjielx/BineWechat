<?php
namespace Bine\wechat\interfaces;

interface UserListInterface
{
    /**
     * @Author RJie
     * @param string $next_openid
     * @return mixed
     */
    public function userGet($next_openid = '');


    /**
     * @Author RJie
     * @param $openid
     * @param $remark
     * @return mixed
     */
    public function updateRemark($openid,$remark);

}
