<?php
/**
 * Created by PhpStorm.
 * User: ratnadeep
 * Date: 11/11/16
 * Time: 8:55 PM
 */

namespace LightPHP\Utils\Filesystem;


use LightPHP\Exceptions\IOException;

class File extends AbstractFileDir
{
    public function __construct($filePath, $create = false)
    {
        if(is_dir($filePath))
        {
            throw new IOException('The path must not be a directory');
        }
        if(!is_file($filePath) && $create)
        {
            touch($filePath);
        }
        parent::__construct($filePath);
    }
    public function getContent() {
        return file_get_contents($this->getFullPath());
    }
    public function putContent($content)
    {
        file_put_contents($this->getFullPath(), $content);
    }
}