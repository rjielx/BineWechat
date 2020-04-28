## 测试版
### 使用说明

##### 安装
```$xslt
composer require rjielx/binewechat
```
#### 在config/app.php中进行注册
```
'providers' => [
    // 其它服务提供者
    \Bine\wechat\providers\WechatConfigProvider::class,
],
```
##### 注册
```
php artisan vendor:publish --provider="Bine\wechat\providers\WechatConfigProvider"
```
> 在config/wechat.php配置公众号信息

#### 初始化
```
$config = config('wechat');
$wechat = new WechatServer($config);
```

#### 使用
```
$wechat->getAccessToken();
......
```
>@method Token getAccessToken() 公众号AccessToken
>@method Token callbackIP() 获取微信callbackIP地址
>
>@method Webpage getCodeUri(array $params) 网页授权，用户同意获取code的路径
>@method Webpage getCode(array $params) 网页授权，用户同意获取code
>@method Webpage getCodeToken(string $code) 网页授权，通过code换取网页授权access_token
>@method Webpage refreshCodeToken(string $refresh_token) 网页授权, 刷新CodeToken
>@method Webpage getOpenInfo(string $openId) 网页授权，获取用户微信信息
>
>@method JsapiJSSDK ticket() JS-SDK验证
>@method JsapiJSSDK initWXJSInterface(string $url, array $jsApiList) 初始JS-SDK配置参数
>
>@method Menu setMenu(array $data,string $data_type = 'array') 创建公众号菜单
>@method Menu queryMenu() 查询公众号菜单信息
>@method Menu deleteMenu() 删除公众号菜单
>
>@method TemplateMessage getIndustry() 获取设置的行业信息
>@method TemplateMessage setIndustry(int $industry_id1, int $industry_id2) 设置所属行业
>@method TemplateMessage getAllPrivateTemplate() 查询所有模板信息
>@method TemplateMessage delPrivateTemplate(string $template_id) 删除模板
>@method TemplateMessage sendTemplateMessage(array $data) 发送模板消息
>
>@method Material getMaterialCount() 查询素材总数
>@method Material getMaterialList(string $type = 'image') 查询永久素材列表
>@method Material uploadImg(string $image) 上传图文消息内的图片获取URL
>@method Material addMaterial(string $img_url,string $type = 'image') 新增其他类型永久素材
>@method Material materialAddNews() 新增永久图文素材
>@method Material getMaterial(string $media_id) 获取永久素材
>@method Material delMaterial(string $media_id) 删除永久素材
>@method Material materialUpdateNews(array $params) 修改永久图文素材
>
>@method MassMessage groupSending(string $content, array $people = [],string $type = 'news',string $is_filter = 'filter') 群发消息
>@method MassMessage massDelete(string $msg_id,int $article_idx = 0) 删除群发
>
>@method Tags tagsCreate(string $tag_name) 创建标签
>@method Tags getTags() 获取公众号已创建的标签
>@method Tags tagsUpdate(int $tag_id,string $tag_name) 编辑标签
>@method Tags tagsDelete(int $tag_id) 删除标签
>@method Tags getUserTags(int $tag_id,string $next_openid = '') 获取标签下粉丝列表

