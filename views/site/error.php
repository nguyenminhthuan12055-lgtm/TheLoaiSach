<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception */

use yii\bootstrap5\Html;
use yii\web\HttpException;

// Việt hóa tiêu đề cho các lỗi HTTP hay gặp; lỗi khác giữ nguyên tên mặc định của Yii
$titles = [
    400 => 'Yêu cầu không hợp lệ',
    403 => 'Không có quyền truy cập',
    404 => 'Không tìm thấy',
    405 => 'Phương thức không được phép',
];
$code = $exception instanceof HttpException ? $exception->statusCode : null;
$this->title = ($code !== null && isset($titles[$code])) ? $titles[$code] . ' (' . $code . ')' : $name;
?>
<div class="text-center mt-5">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="alert alert-danger d-inline-block">
        <?= nl2br(Html::encode($message)) ?>
    </div>
    <p class="mt-3"><?= Html::a('Về trang chủ', Yii::$app->homeUrl, ['class' => 'btn btn-secondary']) ?></p>
</div>
