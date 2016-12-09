<?php
/**
 * Created by PhpStorm.
 * User: ratnadeep
 * Date: 09/12/16
 * Time: 11:12 PM
 */

namespace LightPHP\Http;


class ResponseTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->response = new Response();
    }
    public function testSuccessWithData() {
        $response = $this->response->withData([
            'key' => 'value'
        ]);
        $data = $response->getData();
        $this->assertArrayHasKey('key', $data);
    }
    public function testFailureWithData() {
        $response = $this->response->withData([]);
        $data = $response->getData();
        $this->assertEmpty($data);
    }
    public function testSuccessWithErrors() {
        $response = $this->response->withErrors([
            'message' => 'Internal error'
        ]);
        $errors = $response->getErrors();
        $this->assertArrayHasKey('message', $errors);
    }
    public function testFailureWithErrors() {
        $response = $this->response->withErrors([]);
        $errors = $response->getErrors();
        $this->assertEmpty($errors);
    }
}