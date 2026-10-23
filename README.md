# Quản lý thư viện – CRUD Thể loại sách (Yii2)

Bài tập môn **Phát triển ứng dụng mã nguồn mở**. Đề tài chung của lớp là quản lý thư viện, nhóm mình phụ trách chức năng **thêm / sửa / xóa thể loại sách**, viết bằng framework Yii2 và lưu dữ liệu trong MySQL.

## Chức năng

- Đăng nhập, đăng xuất. Có hai vai trò là `admin` và `user`.
- Xem danh sách thể loại sách: có tìm kiếm theo mã, tên hoặc mô tả, sắp xếp theo cột, phân trang (10 dòng một trang).
- Xem chi tiết một thể loại.
- Thêm, sửa, xóa thể loại (chỉ dành cho `admin`). Khi xóa có hộp thoại hỏi lại.
- Kiểm tra dữ liệu nhập: bắt buộc nhập mã và tên, mã không được trùng, tên không được trùng, độ dài tối đa của từng ô. Mã tự đổi sang chữ hoa khi lưu, và không cho sửa mã sau khi đã tạo.

| Việc cần làm                | Chưa đăng nhập                | `user`           | `admin` |
| --------------------------- | ----------------------------- | ---------------- | ------- |
| Xem danh sách, xem chi tiết | Bị chuyển tới trang đăng nhập | Được             | Được    |
| Thêm, sửa, xóa              | Bị chuyển tới trang đăng nhập | Bị từ chối (403) | Được    |

Tài khoản mẫu, mật khẩu đều là `123456`:

| Tên đăng nhập | Vai trò       |
| ------------- | ------------- |
| `admin`       | Quản trị viên |
| `user1`       | Người dùng    |

## Yêu cầu cài đặt

- PHP 8.2 trở lên, có bật các extension `pdo_mysql`, `mbstring`, `intl`, `ctype`, `dom`, `fileinfo`
- Composer 2
- MySQL hoặc MariaDB (dùng XAMPP là có sẵn)
- Git (nếu clone từ GitHub)

Dự án được kiểm thử với PHP 8.3, MariaDB 10.11, Yii 2.0.55 và yii2-bootstrap5 2.0.4.

## Cài đặt và chạy

**1. Lấy mã nguồn và cài thư viện**

```bash
git clone https://github.com/nguyenminhthuan12055-lgtm/TheLoaiSach/blob/main/README.md library-management-yii
cd library-management-yii
composer install
```

Lệnh `composer install` tự tạo khóa bí mật cho cookie trong `config/web.php`. Nếu khi mở web bị báo lỗi `cookieValidationKey must be configured with a secret key`, bạn tự điền một chuỗi bất kỳ vào dòng `'cookieValidationKey' => '',` rồi lưu lại.

**2. Tạo cơ sở dữ liệu `library_db`**

Mở phpMyAdmin (hoặc dòng lệnh MySQL) và tạo một CSDL trống:

```sql
CREATE DATABASE library_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Nếu MySQL của bạn có user hoặc mật khẩu khác mặc định (`root`, mật khẩu rỗng), sửa trong `config/db.php`.

**3. Tạo bảng và dữ liệu mẫu, chọn một trong hai cách**

- Cách 1 (nên dùng): chạy migration

  ```bash
  php yii migrate
  ```

  Gõ `yes` khi được hỏi.

- Cách 2: import file `database/database.sql` bằng phpMyAdmin (tab Import).

Chỉ chọn một cách. Nếu đã import file SQL rồi mà còn chạy `php yii migrate` thì sẽ báo bảng đã tồn tại.

**4. Chạy ứng dụng**

Dùng máy chủ có sẵn của Yii:

```bash
php yii serve
```

Rồi mở http://localhost:8080. Hoặc nếu dùng XAMPP, đặt thư mục dự án vào `htdocs` và mở `http://localhost/library-management-yii/web/`.

## Cấu trúc thư mục

```
config/        Cấu hình ứng dụng (web.php, db.php, console.php)
controllers/   SiteController (đăng nhập), BookCategoryController (CRUD)
models/        BookCategory, BookCategorySearch, User, LoginForm
views/         Giao diện: layouts, site, book-category
migrations/    Tạo bảng users, book_categories và dữ liệu mẫu
database/      database.sql (cách import thủ công)
web/           Thư mục public, chứa index.php
```

## Lỗi hay gặp

- **`Could not find package ... bower-asset/...`** khi `composer install`: Composer chưa lấy được thư viện front-end. Kiểm tra mạng, và giữ nguyên mục `repositories` (asset-packagist) trong `composer.json`.
- **`SQLSTATE[HY000] [1049] Unknown database 'library_db'`**: chưa tạo CSDL ở bước 2.
- **`SQLSTATE[HY000] [1045] Access denied`**: sai user hoặc mật khẩu MySQL trong `config/db.php`.
- **`could not find driver`**: PHP chưa bật `pdo_mysql`. Trong XAMPP thì thường đã bật sẵn.
- **Lỗi tiếng Việt bị hiện thành ký tự lạ**: CSDL hoặc bảng không dùng `utf8mb4`. Tạo lại CSDL theo lệnh ở bước 2.
