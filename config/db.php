<?php

// Cấu hình kết nối CSDL (XAMPP mặc định: user root, mật khẩu rỗng).
return [
    'class' => \yii\db\Connection::class,
    'dsn' => 'mysql:host=127.0.0.1;dbname=library_db',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4',
];
