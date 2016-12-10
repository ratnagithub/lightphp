<?php
/**
 * Created by PhpStorm.
 * User: ratnadeep
 * Date: 10/12/16
 * Time: 10:52 AM
 */

namespace LightPHP\Utils;


use LightPHP\Utils\Filesystem\Directory;
use org\bovigo\vfs\vfsStream;

class ResourcesTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $structure = [
            'app' => [
                'config' => [],
                'controllers' => [],
                'lib' => []
            ],
            'vendor' => [],
            'public' => []
        ];
        $rootPath = vfsStream::setup('tmp', 777, $structure)->url();
        $this->directory = new Directory($rootPath);
        $this->resources = new Resources($this->directory);
    }
    public function testProjectDirectoryisDirectory()
    {
        $projectDir = $this->resources->getProjectDirectory();
        $this->assertInstanceOf(Directory::class, $projectDir);
    }
    public function testAppDirectoryisDirectory()
    {
        $appDir = $this->resources->getAppDirectory();
        $this->assertInstanceOf(Directory::class, $appDir);
    }
    public function testProjectConfigisDirectory()
    {
        $configDir = $this->resources->getConfigDirectory();
        $this->assertInstanceOf(Directory::class, $configDir);
    }
    public function testControllerDirectoryisDirectory()
    {
        $controllerDir = $this->resources->getControllerDirectory();
        $this->assertInstanceOf(Directory::class, $controllerDir);
    }
}
