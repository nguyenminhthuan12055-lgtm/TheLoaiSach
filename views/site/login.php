<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Đăng nhập';
?>
<div class="card card-login shadow-sm">
    <div class="card-body p-4">
        <h1 class="h4 mb-3"><?= Html::encode($this->title) ?></h1>
        <p class="text-muted">Vui lòng nhập tài khoản để tiếp tục.</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <div class="d-grid mt-3">
                <?= Html::submitButton('Đăng nhập', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        <?php ActiveForm::end(); ?>

        <div class="alert alert-secondary mt-4 mb-0 small">
            Tài khoản mẫu (mật khẩu: <code>123456</code>):<br>
            <code>admin</code> - được thêm/sửa/xóa &nbsp;|&nbsp; <code>user1</code> - chỉ xem
        </div>
    </div>
</div>
