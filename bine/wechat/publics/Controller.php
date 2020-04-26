<?php

namespace Bine\wechat\publics;

use Bine\wechat\config\ApiUrl;

class Controller
{
    use ApiUrl, Property;

    /**
     * Controller constructor.
     * @param array $config
     */
    public function __construct($config = array())
    {
        $this->config = $config;
        $this->token = new Token($config);

        $this->getAccessToken = $this->token->getAccessToken();
    }
}
