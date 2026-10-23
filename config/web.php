<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'library-management',
    'name' => 'Quản lý thư viện',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'vi',
    'timeZone' => 'Asia/Ho_Chi_Minh',
    // Trang mặc định: danh sách thể loại sách
    'defaultRoute' => 'book-category/index',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // Khóa bí mật cho cookie; lệnh "composer install" sẽ tự sinh giá trị này.
            'cookieValidationKey' => 'nmt1205',
        ],
        'user' => [
            'identityClass' => \app\models\User::class,
            // Đăng nhập bằng session (giống project mẫu), không dùng cookie ghi nhớ.
            'enableAutoLogin' => false,
            'loginUrl' => ['site/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
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

return $config;
