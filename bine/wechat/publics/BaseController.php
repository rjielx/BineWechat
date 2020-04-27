<?php
namespace Bine\wechat\publics;

use Bine\wechat\services\JsapiJSSDK;
use Bine\wechat\services\Material;
use Bine\wechat\services\Menu;
use Bine\wechat\services\TemplateMessage;
use Bine\wechat\services\Webpage;

class BaseController
{
    use Property;

    /**
     * BaseController constructor.
     * @param array $config
     * @param array $classify
     * @throws \ErrorException
     */
    public function __construct(array $config = array(),array $classify = array()) {
        if(!$config){
            throw new \ErrorException('配置错误');
        }
        $this->config = $config;

        if(!$classify) {
            $classify = [
                new Token($config),
                new Webpage($config),
                new JsapiJSSDK($config),
                new Menu($config),
                new TemplateMessage($config),
                new Material($config),
            ];
        }
        $this->_parents = $classify;
    }

    /**
     * @Author RJie
     * @param $method
     * @param $args
     * @return mixed
     */
    public function __call($method, $args) {
        // 从“父类"中查找方法
        foreach ($this->_parents as $p) {
            if (is_callable(array($p, $method))) {
                return call_user_func_array(array($p, $method), $args);
            }
        }
        // 恢复默认的行为，会引发一个方法不存在的致命错误
        return call_user_func_array(array($this, $method), $args);
    }

}
