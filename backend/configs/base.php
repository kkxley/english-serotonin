<?php
$db = require __DIR__ . '/db.php';
return [
    'id' => 'english-serotonin',
    'basePath' => dirname(__DIR__),
    'components' => [
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'api/admin/sentences/add' => 'admin/sentences/add',
                'api/admin/sentences' => 'admin/sentences/all',
                'api/<controller:(\w+)>/<action:(\w+)>' => '<controller>/<action>',
                'api/<controller:(\w+)>/' => '<controller>/index',
                'api/sentences/<themePath:[\w,-]+>' => 'sentences/index',
                'api/themes/<themePath:[\w,-]+>' => 'themes/index',
            ]
        ],
        'request' => [
            'enableCookieValidation' => true,
            'enableCsrfValidation' => false,
            'cookieValidationKey' => '123',
        ]
    ]
];