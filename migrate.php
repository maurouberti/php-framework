<?php

require __DIR__ . '/vendor/autoload.php';

$c = require __DIR__ . '/app/config/containers.php';
$c = new Pimple\Container($c);


if (!empty($argv[1]) && $argv[1] == 'refresh') {
    $c['db']->exec('DROP DATABASE IF EXISTS ' . $c['settings']['db']['database']);
    echo 'Database dropped' . PHP_EOL;
}

/** cria banco de dados */
$pdo = new \PDO('mysql:host=localhost;dbname=mysql', $c['settings']['db']['username'], $c['settings']['db']['password']);
$stmt = $pdo->prepare('SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?');
$stmt->execute([$c['settings']['db']['database']]);
$hasDb = $stmt->fetch(\PDO::FETCH_ASSOC);
if (empty($hasDb)) {
    $pdo->exec('CREATE DATABASE ' . $c['settings']['db']['database']);
    echo $c['settings']['db']['database'] . ' database created' . PHP_EOL;
}

/** cria tabela migrations */
$stmt = $c['db']->prepare('SELECT table_name FROM information_schema.tables WHERE table_schema = ? AND table_name = ?');
$stmt->execute([$c['settings']['db']['database'], 'migrations']);
$data = $stmt->fetch();
if (!$data) {
    $file = '00-migrations.sql';
    $sql = file_get_contents(__DIR__ . '/migrates/' . $file);
    $c['db']->exec($sql);

    $stmt = $c['db']->prepare('INSERT INTO migrations (name, created) values (?, ?)');
    $stmt->execute([$file, date('Y-m-d H:i:s')]);
}

/** roda as migrations */
$files = scandir(__DIR__ . '/migrates');
foreach ($files as $file) {
    if (!is_dir(__DIR__ . '/migrates/' . $file)) {
        $stmt = $c['db']->prepare('SELECT * FROM migrations WHERE name = ?');
        $stmt->execute([$file]);
        $data = $stmt->fetch();
        if ($data) {
            continue;
        }

        $sql = file_get_contents(__DIR__ . '/migrates/' . $file);
        $c['db']->exec($sql);

        $stmt = $c['db']->prepare('INSERT INTO migrations (name, created) values (?, ?)');
        $stmt->execute([$file, date('Y-m-d H:i:s')]);

        echo $file . ' is migrated' . PHP_EOL;
    }
}
