<?php

require_once __DIR__ . "/vendor/autoload.php";

use FastRoute\RouteCollector;
use FastRoute\Dispatcher;
use function FastRoute\simpleDispatcher;

\App\Core\Sessions::start();

$uri = $_SERVER['REQUEST_URI'];
$basePath = '/LoginSystem';

if (strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}

$uri = parse_url($uri, PHP_URL_PATH);


if (empty($uri) || $uri[0] !== '/') {
    $uri = '/' . $uri;
}

$dispatcher = simpleDispatcher(function(RouteCollector $r) {
    $r->addRoute('GET', '/', ['App\Controllers\LoginController', 'index']);
    $r->addRoute('POST', '/login', ['App\Controllers\LoginController', 'login']);
    $r->addRoute('GET', '/signup', ['App\Controllers\SignupController', 'index']);
    $r->addRoute('POST', '/signup', ['App\Controllers\SignupController', 'register']);
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case Dispatcher::NOT_FOUND:
        http_response_code(404);
        echo "404 Not Found";
        break;
    case Dispatcher::METHOD_NOT_ALLOWED:
        http_response_code(405);
        echo "405 Method Not Allowed";
        break;
    case Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        try {
            $controller = new $handler[0];
            $method = $handler[1];
            $controller->$method($vars);
        } catch (Throwable $e) {
            http_response_code(500);
            echo "500 Internal Server Error";
            error_log("Contoller error: " . $e->getMessage());
        }
        break;
}