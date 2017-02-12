<?php
/**
 * Created by PhpStorm.
 * User: ratnadeep
 * Date: 09/11/16
 * Time: 11:13 PM
 */

namespace LightPHP\Exceptions;


class NotFoundException extends \Exception implements LightExceptionInterface
{
    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, 404, $previous);
    }
    public function getTitle()
    {
        return "Not Found";
    }

}