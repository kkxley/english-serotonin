<?php
define('YII_ENABLE_ERROR_HANDLER', false);
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/yiisoft/yii2/Yii.php';



$config = require __DIR__ . '/configs/base.php';

(new yii\web\Application($config))->run();