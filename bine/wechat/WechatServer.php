<?php

namespace Bine\wechat;

use Bine\wechat\publics\BaseController;
use Bine\wechat\publics\Token;
use Bine\wechat\services\JsapiJSSDK;
use Bine\wechat\services\Material;
use Bine\wechat\services\Menu;
use Bine\wechat\services\message\MassMessage;
use Bine\wechat\services\message\TemplateMessage;
use Bine\wechat\services\userManage\Blacklist;
use Bine\wechat\services\userManage\Tags;
use Bine\wechat\services\userManage\UserList;
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
 * @method Menu setMenu(array $data, string $data_type = 'array') 创建公众号菜单
 * @method Menu queryMenu() 查询公众号菜单信息
 * @method Menu deleteMenu() 删除公众号菜单
 *
 * @method TemplateMessage getIndustry() 获取设置的行业信息
 * @method TemplateMessage setIndustry(int $industry_id1, int $industry_id2) 设置所属行业
 * @method TemplateMessage getAllPrivateTemplate() 查询所有模板信息
 * @method TemplateMessage delPrivateTemplate(string $template_id) 删除模板
 * @method TemplateMessage sendTemplateMessage(array $data) 发送模板消息
 *
 * @method Material getMaterialCount() 查询素材总数
 * @method Material getMaterialList(string $type = 'image') 查询永久素材列表
 * @method Material uploadImg(string $image) 上传图文消息内的图片获取URL
 * @method Material addMaterial(string $img_url, string $type = 'image') 新增其他类型永久素材
 * @method Material materialAddNews() 新增永久图文素材
 * @method Material getMaterial(string $media_id) 获取永久素材
 * @method Material delMaterial(string $media_id) 删除永久素材
 * @method Material materialUpdateNews(array $params) 修改永久图文素材
 *
 * @method MassMessage groupSending(string $content, array $people, string $type = 'news', string $is_filter = 'filter') 群发消息
 * @method MassMessage massDelete(string $msg_id, int $article_idx = 0) 删除群发
 *
 * @method Tags tagsCreate(string $tag_name) 创建标签
 * @method Tags getTags() 获取公众号已创建的标签
 * @method Tags tagsUpdate(int $tag_id, string $tag_name) 编辑标签
 * @method Tags tagsDelete(int $tag_id) 删除标签
 * @method Tags getUserTags(int $tag_id, string $next_openid = '') 获取标签下粉丝列表
 * @method Tags batchTagging(string $tag_id, array $opinid_list) 批量为用户打标签
 * @method Tags batchUnTagging(string $tag_id, array $opinid_list) 批量为用户取消标签
 * @method Tags getIdList(string $openid) 获取用户身上的标签列表
 *
 * @method UserList userGet(string $next_openid) 获取用户列表
 * @method UserList updateRemark(string $openid, string $remark) 设置用户备注名
 *
 * @method Blacklist getBlacklist(string $begin_openid) 获取公众号的黑名单列表
 * @method Blacklist batchBlacklist(array $openid_list) 拉黑用户
 * @method Blacklist batchUnBlacklist(array $openid_list) 取消拉黑用户
 */
class WechatServer extends BaseController
{

}
