<?php
ini_set('display_errors', 1);

$request = new \Middleware\HTTP\Request();
$kernel = new \Middleware\Kernel($request);

$pipeline = $kernel->build();

$request = $kernel->handle($request, $pipeline);