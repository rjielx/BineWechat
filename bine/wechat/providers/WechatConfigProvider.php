<?php

namespace Bine\wechat\providers;

use Illuminate\Support\ServiceProvider;

class WechatConfigProvider extends ServiceProvider
{
    public function boot()
    {
        // 配置文件
        $this->publishes([
            __DIR__.'/../config/wechat.php' => config_path('wechat.php'),
        ]);

        // 注册表
        $this->loadMigrationsFrom(__DIR__.'/path/to/migrations');
    }
}

