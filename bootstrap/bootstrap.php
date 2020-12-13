<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/containers.php';
require __DIR__ . '/../config/middlewares.php';
require __DIR__ . '/../config/events.php';
require __DIR__ . '/../config/routes.php';

try {
    $result = $router->run();
    $response = new \PHP\Framework\Response;
    $params = [
        'container' => $container,
        'params' => $result['params']
    ];
    foreach ($middlewares['before'] as $middleware) {
        $middleware($container);
    }
    $response($result['callback'], $params);
    foreach ($middlewares['after'] as $middleware) {
        $middleware($container);
    }
} catch (PHP\Framework\Exceptions\HttpException $e) {
    echo "Erro: " . $e->getMessage();
}
