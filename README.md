## 测试版
### 使用说明

**安装**
```$xslt
composer require rjielx/binewechat
```

```
# 网页授权初始化
$config = [
    'appID' => '', 微信公众号ID
    'appsecret' => '', 微信公众号密钥
];
$wechat = new WechatServer($config);
```

