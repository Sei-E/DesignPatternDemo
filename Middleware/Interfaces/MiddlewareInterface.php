<?php

namespace Middleware\Interfaces;

use Middleware\HTTP\RequestInterface;
use Middleware\HTTP\ResponseInterface;

interface MiddlewareInterface
{
    public function process(RequestInterface $request, HttpHandlerInterface $next): ResponseInterface;
}