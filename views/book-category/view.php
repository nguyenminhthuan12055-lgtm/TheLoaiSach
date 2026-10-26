<?php

/** @var yii\web\View $this */
/** @var app\models\BookCategory $model */

use yii\bootstrap5\Html;
use yii\widgets\DetailView;

$this->title = $model->category_name;
$this->params['breadcrumbs'][] = ['label' => 'Thể loại sách', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$isAdmin = Yii::$app->user->identity->isAdmin();
?>
<h1 class="h3 mb-3"><?= Html::encode($this->title) ?></h1>

<?php if ($isAdmin): ?>
    <p>
        <?= Html::a('Sửa', ['update', 'id' => $model->category_code], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Xóa', ['delete', 'id' => $model->category_code], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Bạn có chắc chắn muốn xóa thể loại "' . $model->category_name . '"?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<?php endif ?>

<?= DetailView::widget([
    'model' => $model,
    'options' => ['class' => 'table table-bordered bg-white'],
    'attributes' => [
        'category_code',
        'category_name',
        ['attribute' => 'description', 'value' => $model->description ?: '(chưa có mô tả)'],
    ],
]) ?>

<?= Html::a('&laquo; Quay lại danh sách', ['index'], ['class' => 'btn btn-secondary']) ?>
