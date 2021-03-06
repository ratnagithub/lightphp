<?php
/**
 * Created by PhpStorm.
 * User: ratnadeep
 * Date: 13/11/16
 * Time: 1:13 AM
 */

namespace LightPHP\Exceptions;


class IOException extends \Exception implements LightExceptionInterface
{
    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, 400, $previous);
    }
    public function getTitle()
    {
        return 'Invalid input parameters';
    }
}