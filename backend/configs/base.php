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
                'api/sentences/<themeId:\d{1,4}>' => 'sentences/index',
                'api/<controller:(\w+)>/<action:(\w+)>' => '<controller>/<action>',
                'api/<controller:(\w+)>/' => '<controller>/index',
            ]
        ]
    ]
];