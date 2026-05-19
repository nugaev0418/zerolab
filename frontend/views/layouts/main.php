<?php
/** @var \yii\web\View $this */
/** @var string $content */

use common\models\Setting;
use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);

if (isset($this->params['meta_title'])) {
    $this->title = $this->params['meta_title'];
}
if (isset($this->params['meta_description'])) {
    $this->registerMetaTag([
        'name'    => 'description',
        'content' => $this->params['meta_description'],
    ]);
}

$lang  = Yii::$app->language;
$lang2 = substr($lang, 0, 2);

$route    = Yii::$app->controller->id . '/' . Yii::$app->controller->action->id;
$isActive = function($prefix) use ($route) {
    return strpos($route, $prefix) === 0 ? 'active' : '';
};

$langUrl = function($code) {
    $params = array_merge([''], Yii::$app->request->queryParams, ['language-picker-language' => $code]);
    return Url::to($params);
};

$langMeta = [
    'uz' => ["O'zbek",  'UZ'],
    'ru' => ['Русский', 'RU'],
    'en' => ['English', 'EN'],
];

$navLinks = [
    ['url' => '/',             'label' => Yii::t('app', 'Home page'),   'prefix' => 'site/index'],
    ['url' => '/shop',         'label' => Yii::t('app', 'Products'),    'prefix' => 'shop/'],
    ['url' => '/direction',    'label' => Yii::t('app', 'Направления'), 'prefix' => 'direction/'],
    ['url' => '/site/contact', 'label' => Yii::t('app', 'Contact'),     'prefix' => 'site/contact'],
    ['url' => '/site/about',   'label' => Yii::t('app', 'About'),       'prefix' => 'site/about'],
];

$siteName = Setting::get('site_name') ?: 'ZeroLab';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" type="image/png" href="/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!-- ═══════════════ HEADER ═══════════════ -->
<header class="site-header" id="siteHeader">
    <div class="container">
        <div class="nav-inner">

            <!-- Hamburger (mobile only) -->
            <button class="hamburger" id="hamburgerBtn" onclick="openDrawer()" aria-label="Menu">
                <span></span><span></span><span></span>
            </button>

            <!-- Logo -->
            <a href="/" class="nav-logo">
                <img src="/logo.png" alt="<?= Html::encode($siteName) ?>">
            </a>

            <!-- Desktop navigation links -->
            <nav class="nav-links" aria-label="Main navigation">
                <?php foreach ($navLinks as $item): ?>
                    <a href="<?= $item['url'] ?>"
                       class="nav-link <?= $isActive($item['prefix']) ?>">
                        <?= $item['label'] ?>
                    </a>
                <?php endforeach; ?>
            </nav>

            <!-- Right side: language picker -->
            <div class="nav-right">
                <div class="lang-picker" id="langPicker">
                    <button class="lang-current" onclick="toggleLang(event)" type="button">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24" style="flex-shrink:0;opacity:.6;">
                            <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zm6.93 6h-2.95a15.65 15.65 0 0 0-1.38-3.56A8.03 8.03 0 0 1 18.92 8zM12 4.04c.83 1.2 1.48 2.53 1.91 3.96h-3.82c.43-1.43 1.08-2.76 1.91-3.96zM4.26 14C4.1 13.36 4 12.69 4 12s.1-1.36.26-2h3.38c-.08.66-.14 1.32-.14 2s.06 1.34.14 2H4.26zm.82 2h2.95c.32 1.25.78 2.45 1.38 3.56A7.987 7.987 0 0 1 5.08 16zm2.95-8H5.08a7.987 7.987 0 0 1 4.33-3.56A15.65 15.65 0 0 0 8.03 8zM12 19.96c-.83-1.2-1.48-2.53-1.91-3.96h3.82c-.43 1.43-1.08 2.76-1.91 3.96zM14.34 14H9.66c-.09-.66-.16-1.32-.16-2s.07-1.35.16-2h4.68c.09.65.16 1.32.16 2s-.07 1.34-.16 2zm.25 5.56c.6-1.11 1.06-2.31 1.38-3.56h2.95a8.03 8.03 0 0 1-4.33 3.56zM16.36 14c.08-.66.14-1.32.14-2s-.06-1.34-.14-2h3.38c.16.64.26 1.31.26 2s-.1 1.36-.26 2h-3.38z"/>
                        </svg>
                        <span><?= strtoupper($lang2) ?></span>
                        <svg width="11" height="11" fill="currentColor" viewBox="0 0 16 16" class="lang-chevron">
                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                        </svg>
                    </button>
                    <div class="lang-dropdown" id="langDropdown">
                        <?php foreach ($langMeta as $code => [$fullName, $shortCode]): ?>
                            <a href="<?= $langUrl($code) ?>"
                               class="lang-option <?= ($lang2 === $code) ? 'active' : '' ?>">
                                <span class="lang-option-code"><?= $shortCode ?></span>
                                <span class="lang-option-name"><?= $fullName ?></span>
                                <?php if ($lang2 === $code): ?>
                                    <svg width="14" height="14" fill="#2563eb" viewBox="0 0 16 16" style="margin-left:auto">
                                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                                    </svg>
                                <?php endif; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- ═══════════════ /HEADER ═══════════════ -->

<!-- ═══════════════ MOBILE DRAWER ═══════════════ -->
<div class="mobile-overlay" id="mobileOverlay" onclick="closeDrawer()"></div>
<div class="mobile-drawer" id="mobileDrawer">

    <div class="drawer-header">
        <a href="/" class="drawer-logo">
            <img src="/logo.png" alt="<?= Html::encode($siteName) ?>">
        </a>
        <button class="drawer-close" onclick="closeDrawer()" type="button" aria-label="Close">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
        </button>
    </div>

    <nav class="drawer-nav">
        <?php foreach ($navLinks as $item): ?>
            <a href="<?= $item['url'] ?>"
               class="drawer-link <?= $isActive($item['prefix']) ?>">
                <?= $item['label'] ?>
                <?php if ($isActive($item['prefix']) === 'active'): ?>
                    <span class="drawer-link-dot"></span>
                <?php endif; ?>
            </a>
        <?php endforeach; ?>
    </nav>

    <div class="drawer-footer">
        <p class="drawer-lang-label"><?= Yii::t('app', 'Language') ?></p>
        <div class="drawer-lang">
            <?php foreach ($langMeta as $code => [$fullName, $shortCode]): ?>
                <a href="<?= $langUrl($code) ?>"
                   class="drawer-lang-btn <?= ($lang2 === $code) ? 'active' : '' ?>">
                    <span><?= $shortCode ?></span>
                    <small><?= $fullName ?></small>
                </a>
            <?php endforeach; ?>
        </div>

        <?php if ($phone = Setting::get('phone')): ?>
        <div class="drawer-contact">
            <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24">
                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
            </svg>
            <a href="tel:<?= Html::encode($phone) ?>"><?= Html::encode($phone) ?></a>
        </div>
        <?php endif; ?>
    </div>
</div>
<!-- ═══════════════ /MOBILE DRAWER ═══════════════ -->

<!-- ═══════════════ CONTENT ═══════════════ -->
<main id="main">
    <?= Alert::widget() ?>
    <?= $content ?>
</main>
<!-- ═══════════════ /CONTENT ═══════════════ -->

<!-- ═══════════════ FOOTER ═══════════════ -->
<footer class="site-footer">
    <div class="footer-main">
        <div class="container">
            <div class="footer-grid">

                <!-- Brand column -->
                <div class="footer-col footer-brand">
                    <a href="/" class="footer-logo-link">
                        <img src="/logo.png" alt="<?= Html::encode($siteName) ?>">
                    </a>
                    <?php $about = Setting::get('about_content'); ?>
                    <?php if ($about): ?>
                        <p class="footer-tagline"><?= mb_strimwidth(strip_tags($about), 0, 130, '…') ?></p>
                    <?php endif; ?>
                    <div class="footer-socials">
                        <?php if ($tg = Setting::get('telegram')): ?>
                        <a href="<?= Html::encode($tg) ?>" target="_blank" class="footer-social" title="Telegram">
                            <svg width="17" height="17" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.287 5.906q-1.168.486-4.666 2.01-.567.225-.595.442c-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294q.39.01.868-.32 3.269-2.206 3.374-2.23c.05-.012.12-.026.166.016s.042.12.037.141c-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8 8 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629q.14.092.27.187c.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.4 1.4 0 0 0-.013-.315.34.34 0 0 0-.114-.217.53.53 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09"/>
                            </svg>
                        </a>
                        <?php endif; ?>
                        <?php if ($ig = Setting::get('instagram')): ?>
                        <a href="<?= Html::encode($ig) ?>" target="_blank" class="footer-social" title="Instagram">
                            <svg width="17" height="17" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm.003 1.44c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                            </svg>
                        </a>
                        <?php endif; ?>
                        <?php if ($fb = Setting::get('facebook')): ?>
                        <a href="<?= Html::encode($fb) ?>" target="_blank" class="footer-social" title="Facebook">
                            <svg width="17" height="17" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                            </svg>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Navigation column -->
                <div class="footer-col">
                    <h6 class="footer-col-title"><?= Yii::t('app', 'Navigation') ?></h6>
                    <ul class="footer-nav-list">
                        <?php foreach ($navLinks as $item): ?>
                            <li><a href="<?= $item['url'] ?>"><?= $item['label'] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Contacts column -->
                <div class="footer-col">
                    <h6 class="footer-col-title"><?= Yii::t('app', 'Contacts') ?></h6>
                    <ul class="footer-contact-list">
                        <?php if ($addr = Setting::get('address')): ?>
                        <li>
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                            <span><?= Html::encode($addr) ?></span>
                        </li>
                        <?php endif; ?>
                        <?php if ($phone = Setting::get('phone')): ?>
                        <li>
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                            </svg>
                            <a href="tel:<?= Html::encode($phone) ?>"><?= Html::encode($phone) ?></a>
                        </li>
                        <?php endif; ?>
                        <?php if ($email = Setting::get('email')): ?>
                        <li>
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                            </svg>
                            <a href="mailto:<?= Html::encode($email) ?>"><?= Html::encode($email) ?></a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-inner">
                <span>© <?= date('Y') ?> <?= Html::encode($siteName) ?></span>
                <div class="footer-bottom-langs">
                    <?php foreach ($langMeta as $code => [$fullName, $shortCode]): ?>
                        <a href="<?= $langUrl($code) ?>"
                           class="<?= ($lang2 === $code) ? 'active' : '' ?>">
                            <?= $shortCode ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ═══════════════ /FOOTER ═══════════════ -->

<!-- Back to top -->
<button class="back-to-top" id="backToTop" onclick="window.scrollTo({top:0,behavior:'smooth'})" type="button" aria-label="Back to top">
    <svg width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
    </svg>
</button>

<script>
/* Navbar scroll shadow */
(function() {
    var hdr = document.getElementById('siteHeader');
    window.addEventListener('scroll', function() {
        hdr.classList.toggle('scrolled', window.scrollY > 50);
    }, { passive: true });
})();

/* Mobile drawer */
function openDrawer() {
    document.getElementById('mobileDrawer').classList.add('open');
    document.getElementById('mobileOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeDrawer() {
    document.getElementById('mobileDrawer').classList.remove('open');
    document.getElementById('mobileOverlay').classList.remove('open');
    document.body.style.overflow = '';
}

/* Language dropdown */
function toggleLang(e) {
    e.stopPropagation();
    document.getElementById('langPicker').classList.toggle('open');
}
document.addEventListener('click', function() {
    var lp = document.getElementById('langPicker');
    if (lp) lp.classList.remove('open');
});

/* Back to top */
(function() {
    var btn = document.getElementById('backToTop');
    window.addEventListener('scroll', function() {
        btn.classList.toggle('visible', window.scrollY > 400);
    }, { passive: true });
})();
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
