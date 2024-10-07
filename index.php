<?php

    $filename = __DIR__ . preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
    if (php_sapi_name() === 'cli-server' && is_file($filename)) {
        return false;
    }

    require_once __DIR__ . '/src/Router/Router.php';

    $router = new \src\Router\Router();

    // Custom 404 Handler
    $router->set404(function () {
        header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
        echo '404, route not found!';
    });

    $router->before('GET', '/.*', function () {
        header('X-Powered-By: bramus/router');
    });

    $router->get('/', function () {
       echo 'Hello World';
    });

    $router->get('/hello/(\w+)', function ($name) {
        echo 'Hello ' . htmlentities($name);
    });

    $router->run();