<?php

$composer = require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/Modules.php';

$app = new \PHP\Framework\App($composer, $modules);

$app->run();
