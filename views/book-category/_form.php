<?php

/** @var yii\web\View $this */
/** @var app\models\BookCategory $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

?>
<div class="card shadow-sm">
    <div class="card-body">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'category_code')->textInput([
            'maxlength' => true,
            'readonly' => !$model->isNewRecord, // mã (khóa chính) không được sửa
            'placeholder' => 'Ví dụ: VH',
            'style' => 'text-transform: uppercase;', // hiển thị chữ hoa đúng như khi lưu
        ])->hint($model->isNewRecord ? 'Tối đa 10 ký tự: chữ cái không dấu, chữ số, - hoặc _. Hệ thống tự viết hoa.' : 'Mã thể loại không thể thay đổi.') ?>

        <?= $form->field($model, 'category_name')->textInput(['maxlength' => true, 'placeholder' => 'Ví dụ: Văn học']) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 4, 'maxlength' => true]) ?>

        <div class="mt-3">
            <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Lưu thay đổi', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Hủy', ['index'], ['class' => 'btn btn-secondary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
