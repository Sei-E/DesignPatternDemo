<?php

namespace Middleware\Middlewares;

use Middleware\HTTP\RequestInterface;
use Middleware\HTTP\ResponseInterface;

use Middleware\Interfaces\MiddlewareInterface;
use Middleware\Interfaces\HttpHandlerInterface;

class AfterMiddleware implements MiddlewareInterface
{
    public function process(RequestInterface $request, HttpHandlerInterface $next): ResponseInterface
    {
        $response = $next->handle($request);

        print '⬇AfterMiddleware 通過<br>';
        return $response;
    }
}