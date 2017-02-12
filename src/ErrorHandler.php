<?php
/**
 * Created by PhpStorm.
 * User: ratnadeep
 * Date: 10/11/16
 * Time: 10:13 PM
 */

namespace LightPHP;


use LightPHP\Exceptions\LightExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ErrorHandler
{
    /**
     * Handle Exception
     * @param \Exception $e
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function handleException(\Exception $e, RequestInterface $request, ResponseInterface $response)
    {
        if ($e instanceof LightExceptionInterface)
        {
                $errors = [
                    'status' => $e->getCode(),
                    'title' => $e->getTitle(),
                    'details' => $e->getMessage()
                ];
        } else {
            $errors = [
                'status' => $e->getCode(),
                'title' => 'Internal Server Error',
                'detail' => $e->getMessage()
            ];
        }
        $response = $response->withStatus($errors['status'])
            ->withErrors($errors);
        return $response;
    }

    /**
     * Handles error
     * @param \Throwable $e
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function handleError(\Throwable $e, RequestInterface $request, ResponseInterface $response)
    {
        $response = $response->withStatus(500)
            ->withErrors([
                'status' => 500,
                'title' => $e->getMessage(),
                'details' => $e->getTrace()
            ]);
        return $response;
    }
}