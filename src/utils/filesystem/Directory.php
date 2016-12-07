<?php
/**
 * Created by PhpStorm.
 * User: ratnadeep
 * Date: 11/11/16
 * Time: 8:55 PM
 */

namespace LightPHP\Utils\Filesystem;


use \LightPHP\Exceptions\IOException;

class Directory extends AbstractFileDir
{
    public function __construct($dirPath, $create = false)
    {
        if(!file_exists($dirPath) && $create)
        {
            mkdir($dirPath);
        }
        if(!is_dir($dirPath))
        {
            throw new IOException('The path must be a directory - '.$dirPath);
        }
        parent::__construct($dirPath);
    }
    public function cd($relativePath)
    {
        return new Directory($this->getFullPath().DIRECTORY_SEPARATOR.$relativePath);
    }
    public function mkdir($relativePath)
    {
        return new Directory($this->getFullPath().DIRECTORY_SEPARATOR.$relativePath, true);
    }
    public function ls()
    {
        $files = null;
        $scannedFiles = array_diff(scandir($this->getFullPath()), array('..', '.'));
        foreach ($scannedFiles as $sf)
        {
            $files[] = new File($this->getFullPath().DIRECTORY_SEPARATOR.$sf);
        }
        return $files;
    }
}