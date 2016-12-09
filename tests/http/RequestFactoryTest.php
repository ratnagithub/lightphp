<?php
/**
 * Created by PhpStorm.
 * User: ratnadeep
 * Date: 09/12/16
 * Time: 11:04 PM
 */

namespace LightPHP\Http;


class RequestFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testGetRequest() {
        $request = RequestFactory::getRequest();
        $this->assertInstanceOf(Request::class, $request);
    }
}