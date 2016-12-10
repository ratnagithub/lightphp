<?php
/**
 * Created by PhpStorm.
 * User: ratnadeep
 * Date: 09/11/16
 * Time: 11:21 PM
 */

namespace LightPHP;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class RequestParser
{
    /**
     * @var
     */
    private $controllerObject;
    /**
     * @var String
     */
    private $controllerAction;
    /**
     * @var RequestInterface
     */
    private $request;
    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * RequestParser constructor.
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function __construct(RequestInterface $request, ResponseInterface $response)
    {
        $this->appNamespace = 'ProfcartAPI';

        $this->request = $request;

        $this->response = $response;

        $this->init();
    }

    /**
     * Initialize Controller and Action
     */
    protected function init()
    {

        $path = $this->request->getUri()->getPath();
        $pathsBroken = explode('/', $path);
        $controllerPath = $actionPath = 'index';
        if (!empty($pathsBroken[1])) {
            $controllerPath = $pathsBroken[1];
        }
        if (!empty($pathsBroken[2])) {
            $actionPath = $pathsBroken[2];
        }
        $this->setControllerObject($controllerPath);
        $this->setControllerAction($actionPath);

    }

    /**
     * Sets controller object
     * @param $controllerPath
     */
    protected function setControllerObject($controllerPath)
    {
        $controllerClass = $this->getControllerNamespace($controllerPath);
        if (!class_exists($controllerClass)) {
            throw new \InvalidArgumentException('No Controller found by the name - ' . $controllerClass);
        }
        $controllerObj = new $controllerClass();
        $this->controllerObject = $controllerObj;
    }

    /**
     * Sets controller action
     * @param $actionPath
     */
    protected function setControllerAction($actionPath)
    {
        $controllerAction = $this->getActionName($actionPath);

        $controllerObject = $this->getControllerObject();
        if (!method_exists($controllerObject, $controllerAction)) {
            throw new \InvalidArgumentException('No Action found by the name "' . $controllerAction . '"');
        }
        $this->controllerAction = $controllerAction;
    }

    /**
     * Gets controller namespace
     * @param string $path
     * @return string
     */
    protected function getControllerNamespace($path = 'Index') : string
    {
        return $this->appNamespace . '\Controllers\\' . $path . 'Controller';
    }

    /**
     * Gets Action name
     * @param string $path
     * @return string
     */
    protected function getActionName($path = 'Index') : string
    {
        return strtolower($this->request->getMethod()) . ucfirst($path);
    }

    /**
     * Gets Controller Object
     * @return
     */
    public function getControllerObject()
    {
        return $this->controllerObject;
    }

    /**
     * Get Controller Action
     * @return String
     */
    public function getControllerAction()
    {
        return $this->controllerAction;
    }
}