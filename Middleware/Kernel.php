<?php

namespace Middleware;

use Middleware\HTTP\RequestInterface;
use Middleware\HTTP\ResponseInterface;
use Middleware\Interfaces\KernelInterface;
use Middleware\Interfaces\HttpHandlerInterface;

class Kernel implements KernelInterface
{
    protected $_middlewares;

    //==============================================================================
    //処理
    //==============================================================================

    public function __construct(RequestInterface $request)
    {
        $this->_bootstrap($request);
    }

    protected function _bootstrap($request) {
        $this->_middlewares = [
            \Middleware\Middlewares\HogeMiddleware::class,
            \Middleware\Middlewares\FooMiddleware::class,
            \Middleware\Middlewares\AfterMiddleware::class,

        ];
    }


    public function build(): HttpHandlerInterface
    {
        //配列とは逆の順番でミドルウェアが実行されるため、事前に配列を反転させて、記入した順に実行されるようにする。
        $middlewares = array_reverse($this->_middlewares);
        //初期化式
        $pipeline = new HttpHandler;
        //関数合成を行う
        foreach ($middlewares as $middleware) {
            $objMiddleware = new $middleware;
            $pipeline = new MiddlewareHandler($objMiddleware, $pipeline);
        }
        return $pipeline;
    }

    public function handle(RequestInterface $request, HttpHandlerInterface $pipeline):ResponseInterface
    {
        try {
            return $pipeline->handle($request);

        } catch (\Exception $e) {
            $errorHandler = new ErrorHandler($e);
            return $errorHandler->handle($request);
        }
    }

}