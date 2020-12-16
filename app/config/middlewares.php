<?php

$app->middleware('before', function($container) {
    // echo "<br>Middleware antes<br>";
});

$app->middleware('after', function($container) {
    // echo "<br>Middleware depois<br>";
    // header('content-Type: application/json');
});
