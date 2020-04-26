<?php

namespace Bine\wechat;

use Bine\wechat\publics\BaseController;
use Bine\wechat\publics\Token;
use Bine\wechat\services\Webpage;

/**
 * @method Token getAccessToken() 公众号AccessToken
 *
 * @method Webpage getCodeUri(array $params) 网页授权，用户同意获取code的路径
 * @method Webpage getCode(array $params) 网页授权，用户同意获取code
 * @method Webpage getCodeToken(string $code) 网页授权，通过code换取网页授权access_token
 * @method Webpage refreshCodeToken(string $refresh_token) 网页授权,刷新CodeToken
 * @method Webpage getOpenInfo(string $openId) 网页授权，获取用户微信信息
 */
class WechatServer extends BaseController
{
//    public function test()
//    {
//        return $this->getAccessToken();
//    }
}
