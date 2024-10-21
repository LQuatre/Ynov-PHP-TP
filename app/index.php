<?php

    $filename = __DIR__ . preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
    if (php_sapi_name() === 'cli-server' && is_file($filename)) {
        return false;
    }

    require_once __DIR__ . '/src/Router/Router.php';
    require_once __DIR__ . '/../app/includes/functions.php';

    $router = new \src\Router\Router();

    $router->get('/styles.css', function () {
        header('Content-Type: text/css');
        readfile(__DIR__ . '/assets/style.css');
    });

    $router->get('/js/signup.js', function () {
        header('Content-Type: text/javascript');
        readfile(__DIR__ . '/assets/js/signup.js');
    });

    // Configure le gestionnaire 404 personnalisé
    configure404Handler($router);

    $router->before('GET', '/.*', function () {
        header('X-Powered-By: bramus/router');
    });

    // Configure le routeur avec les pages de la configuration
    configureRouter($router);

    $router->run();