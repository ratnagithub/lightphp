<?php
/**
 * Created by PhpStorm.
 * User: ratnadeep
 * Date: 11/11/16
 * Time: 8:44 PM
 */

namespace LightPHP\Utils;


use LightPHP\Utils\Filesystem\Directory;

class Resources
{
    private $projectDirectory;

    private $appDirectory;

    private $configDirectory;

    private $controllerDirectory;

    private $vendorDirectory;

    public function __construct(Directory $projectDirectory)
    {
        $this->projectDirectory = $projectDirectory;

        $this->appDirectory = $this->projectDirectory->cd('app');

        $this->configDirectory = $this->appDirectory->cd('config');

        $this->controllerDirectory = $this->appDirectory->cd('controllers');

        $this->vendorDirectory = $this->projectDirectory->cd('vendor');
    }

    public function getProjectDirectory()
    {
        return $this->projectDirectory;
    }

    public function getAppDirectory()
    {
        return $this->appDirectory;
    }

    public function getConfigDirectory()
    {
        return $this->configDirectory;
    }

    public function getControllerDirectory()
    {
        return $this->controllerDirectory;
    }

    public function getVendorDirectory()
    {
        return $this->vendorDirectory;
    }

}