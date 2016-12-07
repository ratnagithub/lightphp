<?php
/**
 * Created by PhpStorm.
 * User: ratnadeep
 * Date: 13/11/16
 * Time: 1:26 AM
 */

namespace LightPHP\Utils;


use LightPHP\Exceptions\IOException;
use Symfony\Component\Yaml\Yaml;

class Configuration
{
    private $data = [];
    
    public function __construct(Resources $resources)
    {
        $configFiles = $resources->getConfigDirectory()->ls();
        foreach ($configFiles as $file)
        {
            $data = Yaml::parse($file->getContent());
            if(is_array($data)) {
                $this->data = array_merge($this->data, Yaml::parse($file->getContent()));
            }
        }
    }
    public function get($key) 
    {
        if(empty($this->data[$key])) {
            throw new IOException('No configuration available by the key - '.$key);
        }
        return $this->data[$key]?:null;
    }
}