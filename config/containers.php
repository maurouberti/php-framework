<?php

use Pimple\Container;

$container = new Container();

$container['db'] = function () {
    echo "MYSQL";
    $dsn = 'mysql:host=localhost;dbname=dados';
    $user = 'root';
    $pass = '123456';
    $opt = [
        \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    ];
    $pdo = new \PDO($dsn, $user, $pass, $opt);
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    return $pdo;
};

// use PHP\Framework\DI\Resolver;

// $container = new Resolver;
// $db = $container->resolveMethod(function() {
//     $dsn = 'mysql:host=localhost;dbname=pp_project_manager';
//     $user = 'root';
//     $pass = '123456';
//     $opt = [
//         \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
//     ];
//     $pdo = new \PDO($dsn, $user, $pass, $opt);
//     $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
//     return $pdo;
// });
