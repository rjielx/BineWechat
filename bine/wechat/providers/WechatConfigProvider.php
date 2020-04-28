<?php

namespace Bine\wechat\providers;

use Illuminate\Support\ServiceProvider;

class WechatConfigProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/wechat.php' => config_path('wechat.php'),
        ]);

    }
}

