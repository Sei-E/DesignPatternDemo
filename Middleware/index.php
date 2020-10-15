<?php
use Middleware\HTTP\Request;
require_once '../vendor/autoload.php';

ini_set('display_errors', 1);

$request = new Request();
$kernel = new \Middleware\Kernel($request);

$pipeline = $kernel->build();

//var_dump($pipeline);

$request = $kernel->handle($request, $pipeline);