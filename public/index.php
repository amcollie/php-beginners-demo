<?php

declare(strict_types=1);

use Core\Router;
use Core\Session;
use Core\ValidationException;

session_start();

define('BASE_PATH', dirname(__DIR__) . '/');

require BASE_PATH . 'vendor/autoload.php';
require BASE_PATH . 'Core/functions.php';
require basePath('bootstrap.php');

// spl_autoload_register(function (string $class): void {
//     $class = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
//     require basePath($class) ;
// });


$router = new Router();
require basePath('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->dispatch($uri, $method);
} catch (ValidationException $e) {
    Session::flash('errors', $e->getErrors ());
    Session::flash('old', $e->getOldInput());
    
    return redirect($router->previousUrl());
}

Session::unflash();