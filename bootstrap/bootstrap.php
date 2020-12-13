<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/containers.php';
require __DIR__ . '/../config/events.php';

$app = new \PHP\Framework\App($container);

require __DIR__ . '/../config/middlewares.php';

$router = $app->getRouter();
require __DIR__ . '/../config/routes.php';

$app->run();
