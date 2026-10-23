<?php

use yii\db\Migration;

/**
 * Dữ liệu mẫu: 2 tài khoản (mật khẩu đều là 123456) và 6 thể loại sách.
 */
class m261021_000003_seed_demo_data extends Migration
{
    public function safeUp()
    {
        $hash = Yii::$app->security->generatePasswordHash('123456');

        $this->batchInsert('users', ['username', 'password', 'role'], [
            ['admin', $hash, 'admin'],
            ['user1', $hash, 'user'],
        ]);

        $this->batchInsert('book_categories', ['category_code', 'category_name', 'description'], [
            ['VH', 'Văn học', 'Tiểu thuyết, truyện ngắn, thơ và các tác phẩm văn học trong và ngoài nước.'],
            ['KHCN', 'Khoa học - Công nghệ', 'Sách về khoa học tự nhiên, công nghệ thông tin và kỹ thuật.'],
            ['KT', 'Kinh tế', 'Sách về kinh tế, quản trị, tài chính và khởi nghiệp.'],
            ['TLKN', 'Tâm lý - Kỹ năng sống', 'Sách phát triển bản thân, kỹ năng giao tiếp và tâm lý học.'],
            ['LS', 'Lịch sử - Địa lý', 'Sách về lịch sử, địa lý, văn hóa và các nhân vật lịch sử.'],
            ['TN', 'Thiếu nhi', 'Tiểu thuyết, truyện ngắn, thơ và các tác phẩm văn học trong và ngoài nước.'],
        ]);
    }

    public function safeDown()
    {
        $this->delete('book_categories');
        $this->delete('users');
    }
}
