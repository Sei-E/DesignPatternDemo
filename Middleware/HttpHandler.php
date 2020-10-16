<?php

namespace Middleware;


use Middleware\HTTP\RequestInterface;
use Middleware\HTTP\ResponseInterface;
use Middleware\HTTP\Response;
use Middleware\Interfaces\HttpHandlerInterface;

class HttpHandler implements HttpHandlerInterface
{
    public function handle(RequestInterface $request): ResponseInterface
    {
        print 'コントローラ<br>';

        return new Response();
    }
}