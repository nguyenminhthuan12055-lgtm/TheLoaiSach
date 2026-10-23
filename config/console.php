<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

return [
    'id' => 'library-management-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'vi',
    'timeZone' => 'Asia/Ho_Chi_Minh',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
];
