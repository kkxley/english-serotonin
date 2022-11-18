<?php

return [
    'paths' => [
        'migrations' => __DIR__ . '/db/migrations',
        'seeds' => __DIR__ . '/db/seeds'
    ],
    'environments' => [
        'default_environment' => 'development',
        'production' => [
            'adapter' => 'mysql',
            'host' => 'mariadb',
            'name' => 'english',
            'user' => 'root',
            'pass' => '12341234',
            'port' => '3306',
            'charset' => 'utf8',
        ],
        'development' => [
            'adapter' => 'mysql',
            'host' => 'mariadb',
            'name' => 'english',
            'user' => 'root',
            'pass' => '12341234',
            'port' => '3306',
            'charset' => 'utf8',
        ],
    ]
];
