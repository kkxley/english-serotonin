<?php

return [
    'class' => 'yii\db\Connection',
    'driverName' => 'mariadb',
    'schemaMap' => [
        'mariadb' => SamIT\Yii2\MariaDb\Schema::class
    ],
    'dsn' => 'mysql:host=mariadb;dbname=english',
    'username' => 'root',
    'password' => '12341234',
    'charset' => 'utf8',
];