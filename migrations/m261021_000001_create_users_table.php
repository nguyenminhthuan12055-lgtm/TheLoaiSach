<?php

use yii\db\Migration;

/**
 * Tạo bảng users (tài khoản đăng nhập, có cột role: admin | user).
 */
class m261021_000001_create_users_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('users', [
            'username' => $this->string(50)->notNull(),
            'password' => $this->string(255)->notNull(),
            'role' => $this->string(10)->notNull()->defaultValue('user'),
            'PRIMARY KEY(username)',
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('users');
    }
}
