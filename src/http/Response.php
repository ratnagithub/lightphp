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
    /**
     * @var array
     */
    private $data = [];

    /**
     * @var array
     */
    private $errors = [];

    /**
     * Sets data in Response
     * @param array $data
     * @return Response
     */
    public function withData($data = []):Response
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Gets data
     * @return array
     */
    public function getData() :array
    {
        return $this->data;
    }

    /**
     * Sets errors in Response
     * @param array $errors
     * @return Response
     */
    public function withErrors($errors = []):Response
    {
        $this->errors = $errors;
        return $this;
    }

    /**
     * Gets Errors
     * @return array
     */
    public function getErrors() :array
    {
        return $this->errors;
    }
}