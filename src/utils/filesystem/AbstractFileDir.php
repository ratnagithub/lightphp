<?php
/**
 * Created by PhpStorm.
 * User: ratnadeep
 * Date: 11/11/16
 * Time: 8:57 PM
 */

namespace LightPHP\Utils\Filesystem;


abstract class AbstractFileDir
{
    private $fullPath;

    public function __construct($filePath)
    {
        $this->fullPath = $filePath;
    }

    public function getFullPath()
    {
        return $this->fullPath;
    }
    public function __toString()
    {
       return $this->fullPath;
    }
    public function unlink()
    {
        unlink($this->fullPath);
    }

}