<?php
/**
 * Created by PhpStorm.
 * User: ratnadeep
 * Date: 08/11/16
 * Time: 8:30 PM
 */

namespace LightPHP;


use LightPHP\Http\RequestFactory;
use LightPHP\Http\Response;
use Zend\Diactoros\Response\SapiEmitter;

class API
{
    private $request;
    
    private $response;

    private $errorHandler;
    
    public function __construct()
    {
        $this->request = RequestFactory::getRequest();
        $this->response = new Response();
        $this->errorHandler = new ErrorHandler();
    }
    public function getRequest(){
        return $this->request;
    }
    public function getResponse(){
        return $this->response;
    }
    public function run()
    {
        try {
            $this->process();
        } catch (\Exception $e) {
            $this->response = $this->errorHandler->handleException($e, $this->request, $this->response);
        } catch (\Throwable $e) {
            $this->response = $this->errorHandler->handleError($e, $this->request, $this->response);
        } finally {
            $this->formatResponse();
            $this->respond();
        }
    }

    protected function process() {

        $requestParser = new RequestParser($this->request, $this->response);
        
        $controllerObj = $requestParser->getControllerObject();

        $controllerAction = $requestParser->getControllerAction();

        $controllerResponse = $controllerObj->$controllerAction($this->request, $this->response);
        if(!$controllerResponse instanceof Response) {
           throw new \Exception('No response returned');
        }
        $this->response = $controllerResponse;
    }
    protected function respond () {
        $emitter = new SapiEmitter();
        $emitter->emit($this->response);
    }
    protected function formatResponse() {
        if(!empty($errors = $this->response->getErrors())) {
            $responseText = [
                'errors' => $errors
            ];
        } else {
            $responseText = [
                'data' => $this->response->getData()
            ];
        }
        $this->response = $this->response->withHeader('Content-Type', 'application/json');
        $this->response->getBody()->write(json_encode($responseText));
    }
}