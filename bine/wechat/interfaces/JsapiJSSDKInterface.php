<?php

namespace Bine\wechat\interfaces;

interface JsapiJSSDKInterface
{
    /**
     * @Author RJie
     * @return mixed
     */
    public function ticket();

    /**
     * @Author RJie
     * @param $url
     * @param array $jsApiList
     * @return mixed
     */
    public function initWXJSInterface($url, $jsApiList = []);
}
