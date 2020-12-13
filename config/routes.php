<?php

$router = new PHP\Framework\Router;

$router->get('/user/{id}', '\App\Controllers\UsersController::show');

$router->get('/teste', function() {
    class TestAdapter
    {
        public function __construct($message2 = 'message 2')
        {
            echo 'a) '.TestAdapter::class . "::__construct() $message2<br>";
        }

        public function runTest($message)
        {
            echo 'b) '.$message . "<br>";
        }
    }

    class Tester
    {
        public function __construct(TestAdapter $adapter, string $message = 'Rodou um teste')
        {
            $adapter->runTest($message);
        }
    }

    (new \PHP\Framework\DI\Resolver)->resolveClass('Tester', ['message' => 'xxx']);

    echo '---<p>';

    $func = function(Tester $tester, TestAdapter $test_adapter, $msg = 'Teste de closure') {
        var_dump($test_adapter->runTest($msg));
    };

    (new \PHP\Framework\DI\Resolver)->resolveMethod($func, ['msg'=>'Teste de closure com injeção externa']);
});

$router->get('/info', function() {
    phpinfo();
});

$router->get('/teste/{id}/{nome}', function($params) {
    var_dump($params);
    echo "<br>";
    return 'aki';
});
