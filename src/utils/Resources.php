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
    /**
     * @var Directory
     */
    private $projectDirectory;
    /**
     * @var Directory
     */
    private $appDirectory;
    /**
     * @var Directory
     */
    private $configDirectory;
    /**
     * @var Directory
     */
    private $controllerDirectory;
    /**
     * @var Directory
     */
    private $vendorDirectory;

    /**
     * Resources constructor.
     * @param Directory $projectDirectory
     */
    public function __construct(Directory $projectDirectory)
    {
        $this->projectDirectory = $projectDirectory;

        $this->appDirectory = $this->projectDirectory->cd('app');

        $this->configDirectory = $this->appDirectory->cd('config');

        $this->controllerDirectory = $this->appDirectory->cd('controllers');

        $this->vendorDirectory = $this->projectDirectory->cd('vendor');
    }

    /**
     * Get Project directory
     * @return Directory
     */
    public function getProjectDirectory():Directory
    {
        return $this->projectDirectory;
    }

    /**
     * Get App directory
     * @return Directory
     */
    public function getAppDirectory():Directory
    {
        return $this->appDirectory;
    }

    /**
     * Get Config directory
     * @return Directory
     */
    public function getConfigDirectory():Directory
    {
        return $this->configDirectory;
    }

    /**
     * Get Controller directory
     * @return Directory
     */
    public function getControllerDirectory():Directory
    {
        return $this->controllerDirectory;
    }

    /**
     * Get Vendor directory
     * @return Directory
     */
    public function getVendorDirectory():Directory
    {
        return $this->vendorDirectory;
    }
}