<?php
/**
 * Created by PhpStorm.
 * User: ratnadeep
 * Date: 14/11/16
 * Time: 11:13 AM
 */

namespace LightPHP;


use LightPHP\Utils\MemoryCache;

class Light
{
    private static $container;
    public static function get($serviceName)
    {
        static::setContainer();
        return static::$container->get($serviceName);
    }
    private static function setContainer()
    {
        if(!static::$container) {
            static::$container = (new MemoryCache())->get('container', function () {
                return new Container();
            });
        }
    }
}