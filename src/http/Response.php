<?php
/**
 * Created by PhpStorm.
 * User: ratnadeep
 * Date: 09/11/16
 * Time: 8:04 AM
 */

namespace LightPHP\Http;

use \Zend\Diactoros\Response as ZendResponse;

class Response extends ZendResponse
{
    private $data;

    private $errors;

    public function withData($data = []) {
        $this->data = $data;
        return $this;
    }
    public function getData()
    {
        return $this->data;
    }
    public function withErrors($errors = []) {
        $this->errors = $errors;
        return $this;
    }
    public function getErrors()
    {
        return $this->errors;
    }
}