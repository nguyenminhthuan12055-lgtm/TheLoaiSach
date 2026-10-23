-- Khoi tao CSDL demo "Quan ly thu vien" - chuc nang The loai sach (MariaDB/MySQL)
-- Cach 2 (thay cho "php yii migrate"): import file nay bang phpMyAdmin hoac lenh mysql.
-- Chi chay lan dau tren CSDL trong hoac CSDL chua ton tai. KHONG dung chung voi "php yii migrate".
CREATE DATABASE IF NOT EXISTS `library_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `library_db`;

CREATE TABLE IF NOT EXISTS `users` (
  `username` VARCHAR(50)  NOT NULL PRIMARY KEY,
  `password` VARCHAR(255) NOT NULL,
  `role`     VARCHAR(10)  NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `book_categories` (
  `category_code` VARCHAR(10)  NOT NULL PRIMARY KEY,
  `category_name` VARCHAR(100) NOT NULL,
  `description`   VARCHAR(255) NULL,
  UNIQUE KEY `uq_book_categories_name` (`category_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Hash mau duoi day duoc tao bang password_hash() cua PHP, mat khau goc cua ca 2 tai khoan la 123456
INSERT INTO `users` (`username`, `password`, `role`) VALUES
('admin', '$2y$10$2tB0gf4kvXkvA87RwEm4QeeQzo72o1rthehNSo0cEYgD.auIdKWuW', 'admin'),
('user1', '$2y$10$2tB0gf4kvXkvA87RwEm4QeeQzo72o1rthehNSo0cEYgD.auIdKWuW', 'user');

INSERT INTO `book_categories` (`category_code`, `category_name`, `description`) VALUES
('VH',   'Văn học',               'Tiểu thuyết, truyện ngắn, thơ và các tác phẩm văn học trong và ngoài nước.'),
('KHCN', 'Khoa học - Công nghệ',  'Sách về khoa học tự nhiên, công nghệ thông tin và kỹ thuật.'),
('KT',   'Kinh tế',               'Sách về kinh tế, quản trị, tài chính và khởi nghiệp.'),
('TLKN', 'Tâm lý - Kỹ năng sống', 'Sách phát triển bản thân, kỹ năng giao tiếp và tâm lý học.'),
('LS',   'Lịch sử - Địa lý',      'Sách về lịch sử, địa lý, văn hóa và các nhân vật lịch sử.'),
('TN',   'Thiếu nhi',             NULL);

CREATE DATABASE library_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
