<?php

/** @var yii\web\View $this */
/** @var app\models\BookCategorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

use app\models\BookCategory;
use yii\bootstrap5\Html;
use yii\bootstrap5\LinkPager;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;

$this->title = 'Thể loại sách';
$this->params['breadcrumbs'][] = $this->title;

$isAdmin = Yii::$app->user->identity->isAdmin();
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0"><?= Html::encode($this->title) ?></h1>
    <?php if ($isAdmin): ?>
        <?= Html::a('+ Thêm thể loại', ['create'], ['class' => 'btn btn-success']) ?>
    <?php endif ?>
</div>

<?= Html::beginForm(['index'], 'get', ['class' => 'row g-2 mb-3']) ?>
    <div class="col-sm-8 col-md-6">
        <?= Html::activeTextInput($searchModel, 'keyword', [
            'class' => 'form-control',
            'placeholder' => 'Tìm theo mã, tên hoặc mô tả...',
        ]) ?>
    </div>
    <div class="col-auto">
        <?= Html::submitButton('Tìm kiếm', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Đặt lại', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>
<?= Html::endForm() ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'summary' => false,
    'options' => ['class' => 'grid-view bg-white'],
    'tableOptions' => ['class' => 'table table-striped table-bordered align-middle mb-3'],
    'pager' => ['class' => LinkPager::class],
    //'layout' => "{items}\n<div class=\"d-flex justify-content-between align-items-center\"><div>{summary}</div><div>{pager}</div></div>",
    'emptyText' => 'Không tìm thấy thể loại sách nào.',
    'columns' => [
        ['class' => SerialColumn::class, 'header' => 'STT'],
        [
            'attribute' => 'category_code',
            'format' => 'raw',
            'value' => fn (BookCategory $m) => Html::a(Html::encode($m->category_code), ['view', 'id' => $m->category_code]),
        ],
        'category_name',
        [
            'attribute' => 'description',
            'value' => fn (BookCategory $m) => $m->description ?: '—',
        ],
        [
            'class' => ActionColumn::class,
            'header' => 'Thao tác',
            'headerOptions' => ['class' => 'col-actions'],
            'contentOptions' => ['class' => 'col-actions'],
            // User thường chỉ có nút Xem; admin có đủ Xem / Sửa / Xóa
            'template' => $isAdmin ? '{view} {update} {delete}' : '{view}',
            'buttons' => [
                'view' => fn ($url) => Html::a('Xem', $url, ['class' => 'btn btn-sm btn-outline-info']),
                'update' => fn ($url) => Html::a('Sửa', $url, ['class' => 'btn btn-sm btn-outline-primary']),
                'delete' => fn ($url, BookCategory $m) => Html::a('Xóa', $url, [
                    'class' => 'btn btn-sm btn-outline-danger',
                    'data' => [
                        'confirm' => 'Bạn có chắc chắn muốn xóa thể loại "' . $m->category_name . '"?',
                        'method' => 'post',
                    ],
                ]),
            ],
            'urlCreator' => fn ($action, BookCategory $m) => [$action, 'id' => $m->category_code],
        ],
    ],
]) ?>
