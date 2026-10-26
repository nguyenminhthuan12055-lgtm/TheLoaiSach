<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use yii\bootstrap5\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);

$user = Yii::$app->user->isGuest ? null : Yii::$app->user->identity;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top'],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto'],
        'items' => [
            ['label' => 'Thể loại sách', 'url' => ['/book-category/index'], 'visible' => $user !== null,
                'active' => Yii::$app->controller->id === 'book-category'],
        ],
    ]);
    if ($user === null) {
        echo Html::a('Đăng nhập', ['/site/login'], ['class' => 'btn btn-outline-light']);
    } else {
        echo Html::tag('span', Html::encode($user->username) . ' (' . $user->getRoleLabel() . ')', ['class' => 'navbar-text me-3']);
        echo Html::beginForm(['/site/logout'])
            . Html::submitButton('Đăng xuất', ['class' => 'btn btn-outline-light'])
            . Html::endForm();
    }
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget([
                'homeLink' => ['label' => 'Trang chủ', 'url' => Yii::$app->homeUrl],
                'links' => $this->params['breadcrumbs'],
            ]) ?>
        <?php endif ?>
        <?php foreach (Yii::$app->session->getAllFlashes() as $type => $message): ?>
            <?= Alert::widget(['body' => Html::encode((string) $message), 'options' => ['class' => 'alert-' . $type]]) ?>
        <?php endforeach ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="footer mt-auto py-3 bg-light border-top">
    <div class="container text-muted">
        &copy; <?= date('Y') ?> Quản lý thư viện - Bài tập CRUD Thể loại sách (Yii <?= Yii::getVersion() ?>)
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
