<?php
/**
 * Created by PhpStorm.
 * User: ratnadeep
 * Date: 16/11/16
 * Time: 8:29 PM
 */

namespace LightPHP\Auth;


use OAuth2\Request;
use OAuth2\Storage\ClientCredentialsInterface;
use OAuth2\Storage\UserCredentialsInterface;

class Auth
{
    private $server;

    private $clientCredentials;

    private $userCredentials;

    private $scope;

    public function __construct(
        ClientCredentialsInterface $clientCredentials,
        UserCredentialsInterface $userCredentials,
        ScopeInterface $scope
    )
    {
        $this->clientCredentials = $clientCredentials;
        $this->userCredentials = $userCredentials;
        $this->scope = $scope;
    }

    public function getServer()
    {

    }
    public function sendToken()
    {
        $this->server->handleTokenRequest(Request::createFromGlobals())->send();
    }
    public function authenticateRequest($scope = null)
    {
        // Handle a request to a resource and authenticate the access token
        if (!$this->server->verifyResourceRequest(Request::createFromGlobals(), null, $scope)) {
            $this->server->getResponse()->send();
            die;
        }
    }
}