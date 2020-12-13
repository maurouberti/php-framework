<?php

use App\Models\User;

$middlewares = [
    'before' => [
        function($container) {
            echo "antes";
        }
    ],
    'after' => [
        function($container) {
            echo "antes";
        }
    ],
];
