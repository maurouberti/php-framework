<?php

$app->middleware('before', function($container) {
    // echo "<br>Middleware antes<br>";
    $url = $container['router']->getCurrentUrl();
    if (!preg_match('/^\/api\/*./', $url)) {
        return;
    }

    $data = (new \App\Controllers\UsersController)->getCurrentUser($container);
    $container['loggedUser'] = function () use ($data) {
        return $data;
    };
});

$app->middleware('after', function($container) {
    // echo "<br>Middleware depois<br>";
    $url = $container['router']->getCurrentUrl();
    if (!preg_match('/^\/api\/*./', $url)) {
        return;
    }

    header('content-Type: application/json');
});
