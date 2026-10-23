<?php

/** @var yii\web\View $this */
/** @var app\models\BookCategory $model */

use yii\bootstrap5\Html;

$this->title = 'Thêm thể loại sách';
$this->params['breadcrumbs'][] = ['label' => 'Thể loại sách', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="h3 mb-3"><?= Html::encode($this->title) ?></h1>
<?= $this->render('_form', ['model' => $model]) ?>
