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
    /**
     * @var Container
     */
    private static $container;

    /**
     * get Service
     * @param $serviceName
     * @return Object
     */
    public static function get($serviceName)
    {
        static::setContainer();
        return static::$container->get($serviceName);
    }

    /**
     * Sets Container
     */
    private static function setContainer()
    {
        if (!static::$container) {
            static::$container = (new MemoryCache())->get('container', function () {
                return new Container();
            });
        }
    }
}