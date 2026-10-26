<?php

/** @var yii\web\View $this */
/** @var app\models\BookCategory $model */

use yii\bootstrap5\Html;

$this->title = 'Sửa thể loại: ' . $model->category_name;
$this->params['breadcrumbs'][] = ['label' => 'Thể loại sách', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->category_name, 'url' => ['view', 'id' => $model->category_code]];
$this->params['breadcrumbs'][] = 'Sửa';
?>
<h1 class="h3 mb-3"><?= Html::encode($this->title) ?></h1>
<?= $this->render('_form', ['model' => $model]) ?>
