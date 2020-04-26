<?php

namespace Bine\wechat;

use Bine\wechat\publics\BaseController;
use Bine\wechat\publics\Token;
use Bine\wechat\services\JsapiJSSDK;
use Bine\wechat\services\Menu;
use Bine\wechat\services\TemplateMessage;
use Bine\wechat\services\Webpage;

/**
 * @method Token getAccessToken() 公众号AccessToken
 * @method Token callbackIP() 获取微信callbackIP地址
 *
 * @method Webpage getCodeUri(array $params) 网页授权，用户同意获取code的路径
 * @method Webpage getCode(array $params) 网页授权，用户同意获取code
 * @method Webpage getCodeToken(string $code) 网页授权，通过code换取网页授权access_token
 * @method Webpage refreshCodeToken(string $refresh_token) 网页授权, 刷新CodeToken
 * @method Webpage getOpenInfo(string $openId) 网页授权，获取用户微信信息
 *
 * @method JsapiJSSDK ticket() JS-SDK验证
 * @method JsapiJSSDK initWXJSInterface(string $url, array $jsApiList) 初始JS-SDK配置参数
 *
 * @method Menu setMenu(array $data, $data_type = 'array') 创建公众号菜单
 * @method Menu queryMenu() 查询公众号菜单信息
 * @method Menu deleteMenu() 删除公众号菜单
 *
 * @method TemplateMessage getIndustry() 获取设置的行业信息
 * @method TemplateMessage setIndustry(int $industry_id1, int $industry_id2) 设置所属行业
 * @method TemplateMessage getAllPrivateTemplate() 查询所有模板信息
 * @method TemplateMessage delPrivateTemplate(string $template_id) 删除模板
 */
class WechatServer extends BaseController
{

}
