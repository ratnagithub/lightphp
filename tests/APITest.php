<?php
namespace LightPHP;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class APITest extends \PHPUnit_Framework_TestCase
{
    public function testPsr7Request(){
        $app = new API();
        $request = $app->getRequest();
        $this->assertInstanceOf(RequestInterface::class, $request);
    }
    public function testPsr7Response(){
        $app = new API();
        $response = $app->getResponse();
        $this->assertInstanceOf(ResponseInterface::class, $response);
    }
}
