<?php
/** @var yii\web\View $this */
/** @var \common\models\Slider[]  $sliders */
/** @var \common\models\Category[] $categories */
/** @var \common\models\Product[]  $products */

use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Setting;

$this->title = Setting::get('site_name') ?: 'ZeroLab';
?>

<style>
/* ══════════════════════════════════════
   HERO SLIDER
══════════════════════════════════════ */
.hero-slider {
    position: relative;
    width: 100%;
    height: calc(100vh - 72px);
    min-height: 440px;
    max-height: 700px;
    overflow: hidden;
    background: #0f172a;
    user-select: none;
}
.hs-slide {
    position: absolute;
    inset: 0;
    opacity: 0;
    transition: opacity .85s ease;
    pointer-events: none;
}
.hs-slide.active {
    opacity: 1;
    pointer-events: auto;
}
.hs-slide > img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
}
.hs-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        105deg,
        rgba(10,15,35,.80) 0%,
        rgba(10,15,35,.45) 50%,
        rgba(10,15,35,.12) 100%
    );
}
.hs-content {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    z-index: 3;
}
.hs-box {
    max-width: 600px;
}
.hs-tag {
    display: inline-block;
    background: rgba(37,99,235,.9);
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    padding: 5px 14px;
    border-radius: 20px;
    margin-bottom: 18px;
}
.hs-title {
    font-size: clamp(26px, 5vw, 58px);
    font-weight: 800;
    color: #fff;
    line-height: 1.12;
    margin-bottom: 16px;
    text-shadow: 0 2px 20px rgba(0,0,0,.3);
}
.hs-text {
    font-size: clamp(13px, 1.8vw, 17px);
    color: rgba(255,255,255,.75);
    line-height: 1.7;
    margin-bottom: 34px;
    max-width: 460px;
}
.hs-cta {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: #2563eb;
    color: #fff;
    font-size: 15px;
    font-weight: 600;
    padding: 14px 34px;
    border-radius: 12px;
    text-decoration: none;
    transition: background .2s, transform .2s, box-shadow .2s;
    box-shadow: 0 8px 28px rgba(37,99,235,.4);
}
.hs-cta:hover { background: #1d4ed8; color: #fff; transform: translateY(-3px); box-shadow: 0 12px 36px rgba(37,99,235,.5); text-decoration: none; }

/* Arrows */
.hs-arr {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
    width: 50px; height: 50px;
    border-radius: 50%;
    background: rgba(255,255,255,.12);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,.2);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background .2s, transform .2s;
}
.hs-arr:hover { background: rgba(37,99,235,.85); transform: translateY(-50%) scale(1.08); }
.hs-prev { left: 24px; }
.hs-next { right: 24px; }
@media (max-width: 576px) {
    .hs-prev { left: 12px; }
    .hs-next { right: 12px; }
    .hs-arr { width: 40px; height: 40px; }
}

/* Dots */
.hs-dots {
    position: absolute;
    bottom: 28px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    align-items: center;
    gap: 8px;
    z-index: 10;
}
.hs-dot {
    width: 8px; height: 8px;
    border-radius: 4px;
    background: rgba(255,255,255,.35);
    cursor: pointer;
    transition: width .35s, background .35s;
}
.hs-dot.active { width: 26px; background: #fff; }

/* Fallback hero (no slides) */
.hero-static {
    display: flex;
    align-items: center;
    height: calc(100vh - 72px);
    min-height: 440px;
    max-height: 700px;
    background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #2d3561 100%);
    position: relative;
    overflow: hidden;
}
.hero-static::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    pointer-events: none;
}
/* glow circles */
.hero-static::after {
    content: '';
    position: absolute;
    width: 600px; height: 600px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(37,99,235,.18) 0%, transparent 70%);
    top: -100px; right: -100px;
    pointer-events: none;
}

/* ══════════════════════════════════════
   SECTION HEADER
══════════════════════════════════════ */
.sec-hd {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    margin-bottom: 30px;
    gap: 12px;
}
.sec-title {
    font-size: clamp(20px, 2.8vw, 28px);
    font-weight: 800;
    color: #1e293b;
    line-height: 1;
    position: relative;
    padding-left: 16px;
}
.sec-title::before {
    content: '';
    position: absolute;
    left: 0; top: 2px; bottom: 2px;
    width: 4px;
    background: linear-gradient(to bottom, #2563eb, #7c3aed);
    border-radius: 2px;
}
.sec-link {
    font-size: 13.5px;
    font-weight: 600;
    color: #2563eb;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 5px;
    white-space: nowrap;
    transition: gap .2s, color .2s;
}
.sec-link:hover { gap: 9px; color: #1d4ed8; text-decoration: none; }

/* ══════════════════════════════════════
   CATEGORIES
══════════════════════════════════════ */
.home-cats { padding: 64px 0 56px; }
.cats-scroll {
    display: flex;
    gap: 16px;
    overflow-x: auto;
    padding-bottom: 6px;
    scrollbar-width: none;
    -webkit-overflow-scrolling: touch;
}
.cats-scroll::-webkit-scrollbar { display: none; }
.cat-card {
    flex-shrink: 0;
    width: 148px;
    text-decoration: none;
}
.cat-card:hover { text-decoration: none; }
.cat-img-wrap {
    width: 148px; height: 148px;
    border-radius: 20px;
    overflow: hidden;
    background: #f1f5f9;
    margin-bottom: 11px;
    border: 2px solid #f1f5f9;
    transition: border-color .25s, box-shadow .25s, transform .25s;
}
.cat-card:hover .cat-img-wrap {
    border-color: #2563eb;
    box-shadow: 0 8px 26px rgba(37,99,235,.18);
    transform: translateY(-4px);
}
.cat-img-wrap img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform .4s;
    display: block;
}
.cat-card:hover .cat-img-wrap img { transform: scale(1.1); }
.cat-no-img {
    width: 100%; height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #dbeafe 0%, #eff6ff 100%);
    color: #2563eb;
}
.cat-name {
    font-size: 13px;
    font-weight: 600;
    color: #1e293b;
    text-align: center;
    line-height: 1.3;
    transition: color .2s;
}
.cat-card:hover .cat-name { color: #2563eb; }

/* ══════════════════════════════════════
   NEW ARRIVALS
══════════════════════════════════════ */
.home-arrivals { padding: 0 0 80px; }
.arrivals-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}
@media (max-width: 1200px) { .arrivals-grid { grid-template-columns: repeat(3, 1fr); } }
@media (max-width: 768px)  { .arrivals-grid { grid-template-columns: repeat(2, 1fr); gap: 14px; } }

.btn-center { text-align: center; margin-top: 40px; }
.btn-showall {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #1e293b;
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    padding: 13px 40px;
    border-radius: 10px;
    text-decoration: none;
    transition: background .2s, transform .2s;
}
.btn-showall:hover { background: #2563eb; color: #fff; transform: translateY(-2px); text-decoration: none; }
</style>

<!-- ══════════════════════════════════════
     HERO SLIDER
══════════════════════════════════════ -->
<?php if (!empty($sliders)): ?>
<div class="hero-slider" id="heroSlider">

    <?php foreach ($sliders as $i => $slider): ?>
    <div class="hs-slide <?= $i === 0 ? 'active' : '' ?>">
        <?php if ($slider->image): ?>
            <img src="/upload/slider/<?= Html::encode($slider->image) ?>"
                 alt="<?= Html::encode($slider->getTitle()) ?>">
        <?php endif; ?>
        <div class="hs-overlay"></div>
        <div class="hs-content">
            <div class="container">
                <div class="hs-box">
                    <?php if ($slider->getTitle()): ?>
                        <div class="hs-tag"><?= Yii::t('app', 'New') ?></div>
                        <h1 class="hs-title"><?= Html::encode($slider->getTitle()) ?></h1>
                    <?php endif; ?>
                    <?php if ($slider->getText()): ?>
                        <p class="hs-text"><?= Html::encode($slider->getText()) ?></p>
                    <?php endif; ?>
                    <?php if ($slider->url): ?>
                        <a href="<?= Html::encode($slider->url) ?>" class="hs-cta">
                            <?= Yii::t('app', 'More') ?>
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                            </svg>
                        </a>
                    <?php else: ?>
                        <a href="/shop" class="hs-cta">
                            <?= Yii::t('app', 'Products') ?>
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <?php if (count($sliders) > 1): ?>
    <!-- Arrows -->
    <button class="hs-arr hs-prev" id="hsPrev" type="button" aria-label="Previous">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
            <path d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
        </svg>
    </button>
    <button class="hs-arr hs-next" id="hsNext" type="button" aria-label="Next">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
            <path d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
        </svg>
    </button>
    <!-- Dots -->
    <div class="hs-dots" id="hsDots">
        <?php foreach ($sliders as $i => $s): ?>
            <button class="hs-dot <?= $i === 0 ? 'active' : '' ?>"
                    type="button" aria-label="Slide <?= $i+1 ?>"></button>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<script>
(function() {
    var slider   = document.getElementById('heroSlider');
    if (!slider) return;
    var slides   = slider.querySelectorAll('.hs-slide');
    var dots     = slider.querySelectorAll('.hs-dot');
    var prevBtn  = document.getElementById('hsPrev');
    var nextBtn  = document.getElementById('hsNext');
    var current  = 0;
    var total    = slides.length;
    var timer;
    var touchX   = 0;

    function go(n) {
        slides[current].classList.remove('active');
        if (dots[current]) dots[current].classList.remove('active');
        current = (n % total + total) % total;
        slides[current].classList.add('active');
        if (dots[current]) dots[current].classList.add('active');
    }
    function start() { timer = setInterval(function() { go(current + 1); }, 4500); }
    function reset() { clearInterval(timer); start(); }

    if (prevBtn) prevBtn.onclick = function() { go(current - 1); reset(); };
    if (nextBtn) nextBtn.onclick = function() { go(current + 1); reset(); };
    dots.forEach(function(d, i) { d.onclick = function() { go(i); reset(); }; });

    /* touch swipe */
    slider.addEventListener('touchstart', function(e) { touchX = e.touches[0].clientX; }, { passive: true });
    slider.addEventListener('touchend', function(e) {
        var dx = e.changedTouches[0].clientX - touchX;
        if (Math.abs(dx) > 50) { go(dx < 0 ? current + 1 : current - 1); reset(); }
    }, { passive: true });

    if (total > 1) start();
})();
</script>

<?php else: ?>
<!-- Fallback static hero -->
<div class="hero-static">
    <div class="container" style="position:relative;z-index:2;">
        <div style="max-width:600px;">
            <div class="hs-tag"><?= Html::encode(Setting::get('site_name') ?: 'ZeroLab') ?></div>
            <h1 class="hs-title"><?= Yii::t('app', 'Products') ?></h1>
            <p class="hs-text"><?= Html::encode(Setting::get('about_content') ? mb_strimwidth(strip_tags(Setting::get('about_content')), 0, 160, '…') : '') ?></p>
            <a href="/shop" class="hs-cta">
                <?= Yii::t('app', 'Products') ?>
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                </svg>
            </a>
        </div>
    </div>
</div>
<?php endif; ?>
<!-- /HERO SLIDER -->


<!-- ══════════════════════════════════════
     CATEGORIES
══════════════════════════════════════ -->
<?php if (!empty($categories)): ?>
<section class="home-cats">
    <div class="container">
        <div class="sec-hd">
            <h2 class="sec-title"><?= Yii::t('app', 'Shop by categories') ?></h2>
            <a href="/shop" class="sec-link">
                <?= Yii::t('app', 'View all') ?>
                <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                </svg>
            </a>
        </div>
        <div class="cats-scroll">
            <?php foreach ($categories as $cat): ?>
                <a href="<?= Url::to(['shop/index', 'category[]' => $cat->id]) ?>"
                   class="cat-card">
                    <div class="cat-img-wrap">
                        <?php if ($cat->image): ?>
                            <img src="/upload/category/<?= Html::encode($cat->image) ?>"
                                 alt="<?= Html::encode($cat->getName()) ?>"
                                 loading="lazy">
                        <?php else: ?>
                            <div class="cat-no-img">
                                <svg width="44" height="44" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                                </svg>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="cat-name"><?= Html::encode($cat->getName()) ?></div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- /CATEGORIES -->


<!-- ══════════════════════════════════════
     NEW ARRIVALS
══════════════════════════════════════ -->
<?php if (!empty($products)): ?>
<section class="home-arrivals">
    <div class="container">
        <div class="sec-hd">
            <h2 class="sec-title"><?= Yii::t('app', 'New Arrivals') ?></h2>
            <a href="/shop" class="sec-link">
                <?= Yii::t('app', 'View all') ?>
                <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                </svg>
            </a>
        </div>

        <div class="arrivals-grid">
            <?php foreach ($products as $product): ?>
                <?= $this->render('/shop/_product_card', ['model' => $product]) ?>
            <?php endforeach; ?>
        </div>

        <div class="btn-center">
            <a href="/shop" class="btn-showall">
                <?= Yii::t('app', 'Show all products') ?>
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                </svg>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- /NEW ARRIVALS -->
