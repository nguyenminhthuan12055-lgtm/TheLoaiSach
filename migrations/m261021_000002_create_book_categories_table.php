<?php

use yii\db\Migration;

/**
 * Tạo bảng book_categories (thể loại sách): mã, tên thể loại, mô tả.
 */
class m261021_000002_create_book_categories_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('book_categories', [
            'category_code' => $this->string(10)->notNull(),
            'category_name' => $this->string(100)->notNull()->unique(),
            'description' => $this->string(255)->null(),
            'PRIMARY KEY(category_code)',
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('book_categories');
    }
}
