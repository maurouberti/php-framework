<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/containers.php';
require __DIR__ . '/../routes/routes.php';

try {
    $result = $router->run();
    $response = new \PHP\Framework\Response;
    $params = [
        'container' => $container,
        'params' => $result['params']
    ];
    $response($result['callback'], $params);
} catch (PHP\Framework\Exceptions\HttpException $e) {
    echo "Erro: " . $e->getMessage();
}
