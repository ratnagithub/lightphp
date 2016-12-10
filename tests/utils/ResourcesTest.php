<?php
/**
 * Created by PhpStorm.
 * User: ratnadeep
 * Date: 10/12/16
 * Time: 10:52 AM
 */

namespace LightPHP\Utils;


use LightPHP\Utils\Filesystem\Directory;

class ResourcesTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->directory = new Directory('/tmp', true);
        //var_dump($this->directory);exit;
        $this->resources = new Resources($this->directory);
    }
    public function testProjectDirectoryisDirectory()
    {
        $projectDir = $this->resources->getProjectDirectory();
        $this->assertInstanceOf(Directory::class, $projectDir);
    }
    public function testControllerDirectoryisDirectory()
    {
        $controllerDir = $this->resources->getControllerDirectory();
        $this->assertInstanceOf(Directory::class, $controllerDir);
    }
    public function tearDown()
    {
        $this->directory->unlink();
    }
}
