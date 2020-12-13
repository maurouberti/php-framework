<?php

$container['events'] = function () {
    return new \Zend\EventManager\EventManager;
};

$container['db'] = function () {
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
