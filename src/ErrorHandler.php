<?php
/**
 * Created by PhpStorm.
 * User: ratnadeep
 * Date: 10/11/16
 * Time: 10:13 PM
 */

namespace LightPHP;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ErrorHandler
{
    public function handleException(\Exception $e, RequestInterface $request, ResponseInterface $response) {
        if($e instanceof \InvalidArgumentException) {
            $errors = [
                'status' => 400,
                'title' => 'Invalid request',
                'details' => 'Invalid URL or parameter'
            ];
        } else {
            $errors = [
                'status' => 500,
                'title' => 'Internal Server Error',
                'detail' => 'An internal server error occured. Please try again after some time'
            ];
        }
        $response = $response->withStatus($errors['status'])
            ->withErrors($errors);
        return $response;
    }
    public function handleError(\Throwable $e, RequestInterface $request, ResponseInterface $response) {
        $response = $response->withStatus(500)
            ->withErrors([
                'status' => 500,
                'title' => 'Internal Server Error',
                'detail' => 'An internal server error occured. Please try again after some time'
            ]);
        return $response;
    }
}