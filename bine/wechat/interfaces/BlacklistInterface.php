<?php
namespace Bine\wechat\interfaces;

interface BlacklistInterface
{
    /**
     * @Author RJie
     * @param $begin_openid
     * @return mixed
     */
    public function getBlacklist($begin_openid);


    /**
     * @Author RJie
     * @param array $openid_list
     * @return mixed
     */
    public function batchBlacklist(array $openid_list);


    /**
     * @Author RJie
     * @param array $openid_list
     * @return mixed
     */
    public function batchUnBlacklist(array $openid_list);
}
