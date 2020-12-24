<?php

$container['events'] = function () {
    return new \Zend\EventManager\EventManager;
};

$container['settings'] = function () {
    return [
            'db' => [
                'dsn' => 'mysql:host=localhost;',
                'database' => 'php_framework',
                'username' => 'root',
                'password' => '123456',
                'options' => [
                    \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                ]
            ]
        ];
};

$container['db'] = function ($c) {
    $dsn = $c['settings']['db']['dsn'] . 'dbname=' . $c['settings']['db']['database'];
    $user = $c['settings']['db']['username'];
    $pass = $c['settings']['db']['password'];
    $opt = $c['settings']['db']['options'];

    $pdo = new \PDO($dsn, $user, $pass, $opt);
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    return $pdo;
};

$container['user_model'] = function ($c) {
    return new \App\Models\User($c);
};

return $container;
