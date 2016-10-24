<?php

require_once __DIR__ . '/../app/autoload.php';
require_once __DIR__ . '/../app/ServiceKernel.php';

use Symfony\Component\HttpFoundation\Request;
use Dotenv\Dotenv;

// Load environment variables Please Note: it don't overwrite existing one
$dotenv = new Dotenv(__DIR__ . '/../');
$dotenv->load();

// Handle the Request
$request = Request::createFromGlobals();
$kernel = new ServiceKernel(
    $_SERVER['SYMFONY_ENV'],
    (bool)$_SERVER['SYMFONY_DEBUG']
);

// Create and send Response
$response = $kernel->handle($request);
$response->send();

$kernel->terminate($request, $response);
