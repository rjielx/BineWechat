<?php

namespace Bine\wechat\interfaces;

interface WebpageInterface
{
    /**
     * @Author RJie
     * @param $params
     * @return mixed
     */
    public function getCodeUri($params);

    /**
     * @Author RJie
     * @param $params
     * @return mixed
     */
    public function getCode($params);

    /**
     * @Author RJie
     * @param $code
     * @return mixed
     */
    public function getCodeToken($code);

    /**
     * @Author RJie
     * @param $refresh_token
     * @return mixed
     */
    public function refreshCodeToken($refresh_token);

    /**
     * @Author RJie
     * @param $openId
     * @return mixed
     */
    public function getOpenInfo($openId);
}
