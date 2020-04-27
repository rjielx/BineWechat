<?php

namespace Bine\wechat\interfaces;

interface TokenInterface
{
    /**
     * TokenInterface constructor.
     * @param array $config
     */
    public function __construct(array $config);

    /**
     * @Author RJie
     * @return mixed
     */
    public function getAccessToken();

    /**
     * @Author RJie
     * @return mixed
     */
    public function callbackIP();

}
