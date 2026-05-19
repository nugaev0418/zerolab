<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;

AppAsset::register($this);

$this->registerCssFile('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
$this->registerCssFile('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css');

$ctrl = Yii::$app->controller->id;

$isActive = function($id) use ($ctrl) {
    return $ctrl === $id ? 'active' : '';
};

$menuItems = [
    ['label' => Yii::t('app', 'Dashboard'),   'icon' => 'bi-house',        'url' => ['/site/index'],           'id' => 'site'],
    ['label' => Yii::t('app', 'Categories'),  'icon' => 'bi-folder2-open', 'url' => ['/category/index'],       'id' => 'category'],
    ['label' => Yii::t('app', 'Directions'),  'icon' => 'bi-compass',      'url' => ['/direction/index'],      'id' => 'direction'],
    ['label' => Yii::t('app', 'Products'),    'icon' => 'bi-box-seam',     'url' => ['/product/index'],        'id' => 'product'],
    ['label' => Yii::t('app', 'Brands'),      'icon' => 'bi-award',        'url' => ['/brand/index'],          'id' => 'brand'],
    ['label' => Yii::t('app', 'Messages'),    'icon' => 'bi-chat-text',    'url' => ['/message/index'],        'id' => 'message'],
    ['label' => Yii::t('app', 'Sources'),     'icon' => 'bi-translate',    'url' => ['/message-source/index'], 'id' => 'message-source'],
    ['label' => Yii::t('app', 'Settings'),    'icon' => 'bi-gear',         'url' => ['/setting'],              'id' => 'setting'],
];

$lang = substr(Yii::$app->language, 0, 2);
$langUrl = function($code) {
    return \yii\helpers\Url::to(['/site/lang', 'lang' => $code]);
};
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> — <?= Html::encode(Yii::$app->name) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="admin-wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        <a href="<?= \yii\helpers\Url::to(['/site/index']) ?>" class="sidebar-brand">
            <div class="brand-icon">
                <i class="bi bi-grid-3x3-gap-fill"></i>
            </div>
            <span class="brand-name"><?= Html::encode(Yii::$app->name) ?></span>
        </a>

        <nav class="sidebar-nav">
            <div class="nav-section-title"><?= Yii::t('app', 'Main') ?></div>
            <?php foreach ($menuItems as $item): ?>
                <a href="<?= Html::encode(\yii\helpers\Url::to($item['url'])) ?>"
                   class="nav-item-link <?= $isActive($item['id']) ?>"
                   data-tooltip="<?= Html::encode($item['label']) ?>">
                    <span class="nav-icon"><i class="bi <?= $item['icon'] ?>"></i></span>
                    <span class="nav-label"><?= Html::encode($item['label']) ?></span>
                </a>
            <?php endforeach; ?>
        </nav>

        <div class="sidebar-footer">
            <a href="/" target="_blank" class="nav-item-link" data-tooltip="<?= Yii::t('app', 'Go to site') ?>">
                <span class="nav-icon"><i class="bi bi-box-arrow-up-right"></i></span>
                <span class="nav-label"><?= Yii::t('app', 'Go to site') ?></span>
            </a>
        </div>

    </aside>
    <!-- /SIDEBAR -->

    <!-- MAIN -->
    <div class="main-wrapper" id="mainWrapper">

        <!-- Top Header -->
        <header class="top-header">
            <div class="header-left">
                <button class="sidebar-toggle-btn" id="sidebarToggle" type="button">
                    <i class="bi bi-list"></i>
                </button>
                <?php if (!empty($this->params['breadcrumbs'])): ?>
                    <nav class="d-none d-md-flex" aria-label="breadcrumb">
                        <?= Breadcrumbs::widget([
                            'links'   => $this->params['breadcrumbs'],
                            'options' => ['class' => 'breadcrumb mb-0'],
                        ]) ?>
                    </nav>
                <?php endif; ?>
            </div>

            <div class="header-right">
                <!-- Language switcher -->
                <div class="lang-switcher">
                    <?php foreach (['uz' => 'UZ', 'ru' => 'RU', 'en' => 'EN'] as $code => $label): ?>
                        <a href="<?= Html::encode($langUrl($code)) ?>"
                           class="lang-btn<?= $lang === $code ? ' active' : '' ?>">
                            <?= $label ?>
                        </a>
                    <?php endforeach; ?>
                </div>

                <?php if (!Yii::$app->user->isGuest): ?>
                    <div class="user-badge">
                        <div class="user-avatar">
                            <?= strtoupper(substr(Yii::$app->user->identity->username, 0, 1)) ?>
                        </div>
                        <span class="user-name d-none d-sm-inline">
                            <?= Html::encode(Yii::$app->user->identity->username) ?>
                        </span>
                    </div>
                    <?= Html::beginForm(['/site/logout'], 'post', ['style' => 'display:inline-block']) ?>
                        <button type="submit" class="btn-logout">
                            <i class="bi bi-box-arrow-right"></i>
                            <span class="d-none d-sm-inline"><?= Yii::t('app', 'Logout') ?></span>
                        </button>
                    <?= Html::endForm() ?>
                <?php else: ?>
                    <a href="<?= \yii\helpers\Url::to(['/site/login']) ?>" class="btn btn-primary btn-sm">
                        <i class="bi bi-box-arrow-in-right"></i> Kirish
                    </a>
                <?php endif; ?>
            </div>
        </header>
        <!-- /Top Header -->

        <!-- Page Content -->
        <main class="page-content">
            <?= Alert::widget() ?>
            <?= $content ?>
        </main>

    </div>
    <!-- /MAIN -->

</div>

<!-- Mobile overlay -->
<div id="sidebarOverlay" onclick="closeSidebar()" style="
    display:none;position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:999;
"></div>

<script>
(function () {
    var sidebar = document.getElementById('sidebar');
    var wrapper = document.getElementById('mainWrapper');
    var overlay = document.getElementById('sidebarOverlay');
    var btn     = document.getElementById('sidebarToggle');

    function isMobile() { return window.innerWidth <= 768; }

    // restore collapsed state on desktop
    if (!isMobile() && localStorage.getItem('sb_collapsed') === '1') {
        sidebar.classList.add('collapsed');
        wrapper.classList.add('expanded');
    }

    btn.addEventListener('click', function () {
        if (isMobile()) {
            var open = sidebar.classList.toggle('mobile-open');
            overlay.style.display = open ? 'block' : 'none';
        } else {
            var collapsed = sidebar.classList.toggle('collapsed');
            wrapper.classList.toggle('expanded', collapsed);
            localStorage.setItem('sb_collapsed', collapsed ? '1' : '0');
        }
    });

    window.closeSidebar = function () {
        sidebar.classList.remove('mobile-open');
        overlay.style.display = 'none';
    };
})();
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage(); ?>
