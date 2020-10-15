<?php

namespace Middleware\Interfaces;

use Middleware\HTTP\RequestInterface;
use Middleware\HTTP\ResponseInterface;

interface KernelInterface
{
    public function __construct(RequestInterface $request);

    public function build():HttpHandlerInterface;

    public function handle(RequestInterface $request, HttpHandlerInterface $pipeline):ResponseInterface;
}