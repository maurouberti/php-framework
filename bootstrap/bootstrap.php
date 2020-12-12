<?php

require __DIR__ . '/../vendor/autoload.php';

$router = new PHP\Framework\Router;

$router->get('/teste/{id}/{nome}', function($params) {
    var_dump($params);
    echo "<br>";


    return 'aki';
});

try {
    echo $router->run();
} catch (PHP\Framework\Exceptions\HttpException $e) {
    echo "Erro: " . $e->getMessage();
}
