<?php
/**
 * Created by PhpStorm.
 * User: ratnadeep
 * Date: 09/11/16
 * Time: 9:21 AM
 */

namespace LightPHP\Http;


use Zend\Diactoros\ServerRequestFactory;

class RequestFactory extends ServerRequestFactory
{
    /**
     * Factory to get Request object from global variables
     * @return Request
     */
    public static function getRequest() {
        $server  = static::normalizeServer($_SERVER);
        $files   = static::normalizeFiles($_FILES);
        $headers = static::marshalHeaders($server);

        return new Request(
            $server,
            $files,
            static::marshalUriFromServer($server, $headers),
            static::get('REQUEST_METHOD', $server, 'GET'),
            'php://input',
            $headers,
            $_COOKIE,
            $_GET,
            $_POST
        );
    }
}