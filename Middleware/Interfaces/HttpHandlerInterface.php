<?php

namespace Middleware\Interfaces;

use Middleware\HTTP\RequestInterface;
use Middleware\HTTP\ResponseInterface;

interface HttpHandlerInterface
{
    // リクエストからレスポンスを作成する処理を実行
    function handle(RequestInterface $request): ResponseInterface;
}