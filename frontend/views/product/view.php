<?php

use common\models\Setting;
use yii\helpers\Html;
use yii\helpers\Url;

$lang  = Yii::$app->language;
$this->title = $model->{'meta_title_' . $lang} ?: $model->{'name_' . $lang};

$mainImg   = $model->image ? '/upload/product/' . $model->image : null;
$allImages = $model->images;
?>

<!-- Hero breadcrumb -->
<div class="page-hero" style="padding:36px 0 28px;">
    <div class="container">
        <div class="breadcrumb-hero">
            <a href="/"><?= Yii::t('app', 'Home page') ?></a>
            <span>›</span>
            <a href="<?= Url::to(['shop/index']) ?>"><?= Yii::t('app', 'Products') ?></a>
            <?php if ($model->category): ?>
                <span>›</span>
                <a href="<?= Url::to(['shop/index', 'category' => [$model->category->id]]) ?>">
                    <?= Html::encode($model->category->getName()) ?>
                </a>
            <?php endif; ?>
            <span>›</span>
            <span><?= Html::encode($model->{'name_' . $lang}) ?></span>
        </div>
    </div>
</div>

<!-- Product Section -->
<section class="pv-section">
    <div class="container">
        <div class="pv-layout">

            <!-- LEFT: Images -->
            <div class="pv-gallery">
                <div class="pv-main-img" id="pvMainImgWrap">
                    <?php if ($mainImg): ?>
                        <img id="pvMainImg" src="<?= $mainImg ?>" alt="<?= Html::encode($model->getName()) ?>">
                    <?php else: ?>
                        <div class="pv-no-img">
                            <svg width="64" height="64" fill="#cbd5e1" viewBox="0 0 24 24">
                                <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                            </svg>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if (count($allImages) > 0): ?>
                <div class="pv-thumbs">
                    <?php if ($mainImg): ?>
                        <div class="pv-thumb active" onclick="pvSetImg('<?= $mainImg ?>', this)">
                            <img src="<?= $mainImg ?>" alt="">
                        </div>
                    <?php endif; ?>
                    <?php foreach ($allImages as $img): ?>
                        <?php $src = '/upload/product/' . $img->image; ?>
                        <div class="pv-thumb" onclick="pvSetImg('<?= $src ?>', this)">
                            <img src="<?= $src ?>" alt="" loading="lazy">
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- RIGHT: Info -->
            <div class="pv-info">

                <!-- Tags -->
                <div class="pv-tags">
                    <?php if ($model->category): ?>
                        <a href="<?= Url::to(['shop/index', 'category' => [$model->category->id]]) ?>" class="pv-tag">
                            <?= Html::encode($model->category->getName()) ?>
                        </a>
                    <?php endif; ?>
                    <?php if ($model->direction): ?>
                        <a href="<?= Url::to(['direction/view', 'slug' => $model->direction->slug]) ?>" class="pv-tag pv-tag-blue">
                            <?= Html::encode($model->direction->getName()) ?>
                        </a>
                    <?php endif; ?>
                </div>

                <h1 class="pv-title"><?= Html::encode($model->{'name_' . $lang}) ?></h1>

                <!-- Meta rows -->
                <div class="pv-meta-list">
                    <?php if ($model->brand): ?>
                    <div class="pv-meta-row">
                        <span class="pv-meta-label"><?= Yii::t('app', 'Brand') ?></span>
                        <a href="<?= Url::to(['brand/view', 'slug' => $model->brand->slug]) ?>"
                           class="pv-meta-value pv-brand-link">
                            <?= Html::encode($model->brand->{'name_' . $lang}) ?>
                        </a>
                    </div>
                    <?php endif; ?>

                    <?php if ($model->catalog_number): ?>
                    <div class="pv-meta-row">
                        <span class="pv-meta-label"><?= Yii::t('app', 'Catalog Number') ?></span>
                        <span class="pv-meta-value pv-catalog"><?= Html::encode($model->catalog_number) ?></span>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if ($model->{'short_description_' . $lang}): ?>
                <div class="pv-short-desc">
                    <?= Html::encode($model->{'short_description_' . $lang}) ?>
                </div>
                <?php endif; ?>

                <!-- CTA Buttons -->
                <div class="pv-cta">
                    <a target="_blank" href="<?= Setting::get('telegram') ?>" class="pv-btn-primary">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.287 5.906q-1.168.486-4.666 2.01-.567.225-.595.442c-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294q.39.01.868-.32 3.269-2.206 3.374-2.23c.05-.012.12-.026.166.016s.042.12.037.141c-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8 8 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629q.14.092.27.187c.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.4 1.4 0 0 0-.013-.315.34.34 0 0 0-.114-.217.53.53 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09"/>
                        </svg>
                        <?= Yii::t('app', 'Find out the price') ?>
                    </a>
                    <a target="_blank" href="<?= Setting::get('telegram') ?>" class="pv-btn-outline">
                        <?= Yii::t('app', 'Telegram channel') ?>
                    </a>
                </div>

                <!-- Share / Back -->
                <div class="pv-footer-actions">
                    <a href="<?= Url::to(['shop/index']) ?>" class="pv-back-link">
                        ← <?= Yii::t('app', 'Back to catalog') ?>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Description / Reviews Tabs -->
<section class="pv-tabs-section">
    <div class="container">

        <div class="pv-tabs">
            <button class="pv-tab-btn active" onclick="pvTab(this, 'tab-desc')">
                <?= Yii::t('app', 'Description') ?>
            </button>
            <button class="pv-tab-btn" onclick="pvTab(this, 'tab-reviews')">
                <?= Yii::t('app', 'Review') ?>
                <?php $reviewCount = count($model->reviews); ?>
                <?php if ($reviewCount > 0): ?>
                    <span class="pv-tab-badge"><?= $reviewCount ?></span>
                <?php endif; ?>
            </button>
        </div>

        <div class="pv-tab-content active" id="tab-desc">
            <?php if ($model->{'description_' . $lang}): ?>
                <div class="pv-description">
                    <?= $model->{'description_' . $lang} ?>
                </div>
            <?php else: ?>
                <p style="color:#94a3b8;padding:24px 0;"><?= Yii::t('app', 'No description') ?></p>
            <?php endif; ?>
        </div>

        <div class="pv-tab-content" id="tab-reviews">
            <!-- Reviews list -->
            <?php $reviews = $model->reviews; ?>
            <?php if (count($reviews)): ?>
                <div class="pv-reviews-list" id="review-list">
                    <?php foreach ($reviews as $review): ?>
                        <div class="pv-review-item">
                            <div class="pv-review-header">
                                <div class="pv-review-avatar">
                                    <?= strtoupper(substr($review->full_name ?? 'U', 0, 1)) ?>
                                </div>
                                <div>
                                    <div class="pv-review-name"><?= Html::encode($review->full_name) ?></div>
                                    <div class="pv-review-date">
                                        <?= Yii::$app->formatter->asRelativeTime($review->created_at) ?>
                                    </div>
                                </div>
                                <?php if ($review->rating): ?>
                                <div class="pv-review-stars">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <span class="<?= $i <= $review->rating ? 'star-fill' : 'star-empty' ?>">★</span>
                                    <?php endfor; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <p class="pv-review-text"><?= Html::encode($review->review) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="pv-no-reviews"><?= Yii::t('app', 'No reviews yet. Be the first!') ?></p>
            <?php endif; ?>

            <!-- Write review form -->
            <div class="pv-review-form-wrap">
                <h5 class="pv-review-form-title"><?= Yii::t('app', 'Write a review') ?></h5>
                <form id="review-form" class="pv-review-form">
                    <input type="hidden" name="product_id" value="<?= $model->id ?>">
                    <div class="pv-form-row">
                        <input type="text" name="full_name" class="pv-input"
                               placeholder="<?= Yii::t('app', 'Your name') ?>" required>
                        <select name="rating" class="pv-input">
                            <?php for ($i = 5; $i >= 1; $i--): ?>
                                <option value="<?= $i ?>"><?= str_repeat('★', $i) ?> <?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <textarea name="review" class="pv-input pv-textarea"
                              placeholder="<?= Yii::t('app', 'Your review') ?>" required></textarea>
                    <button type="submit" class="pv-btn-primary" style="width:auto;padding:11px 28px;">
                        <?= Yii::t('app', 'Submit') ?>
                    </button>
                </form>
            </div>
        </div>

    </div>
</section>

<style>
/* ---- PRODUCT VIEW ---- */
.pv-section { padding: 36px 0 40px; }

.pv-layout {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 48px;
    align-items: start;
}
@media(max-width:768px) { .pv-layout { grid-template-columns: 1fr; gap: 24px; } }

/* Gallery */
.pv-gallery {}
.pv-main-img {
    width: 100%;
    aspect-ratio: 4/3;
    border-radius: 16px;
    overflow: hidden;
    background: #f8fafc;
    border: 1px solid #e8ecf0;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 12px;
}
.pv-main-img img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: transform .4s;
}
.pv-main-img:hover img { transform: scale(1.03); }
.pv-no-img { color: #cbd5e1; }

.pv-thumbs {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}
.pv-thumb {
    width: 72px;
    height: 72px;
    border-radius: 10px;
    overflow: hidden;
    border: 2px solid #e8ecf0;
    cursor: pointer;
    transition: border-color .2s;
    background: #f8fafc;
}
.pv-thumb img { width: 100%; height: 100%; object-fit: cover; }
.pv-thumb:hover, .pv-thumb.active { border-color: #2563eb; }

/* Info */
.pv-tags { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 14px; }
.pv-tag {
    display: inline-block;
    background: #f1f5f9;
    color: #475569;
    font-size: 12px;
    font-weight: 500;
    padding: 4px 12px;
    border-radius: 20px;
    text-decoration: none;
    transition: background .2s;
}
.pv-tag:hover { background: #e2e8f0; color: #1e293b; text-decoration: none; }
.pv-tag-blue { background: #dbeafe; color: #1d4ed8; }
.pv-tag-blue:hover { background: #bfdbfe; color: #1d4ed8; }

.pv-title {
    font-size: 28px;
    font-weight: 700;
    color: #1e293b;
    line-height: 1.3;
    margin: 0 0 20px;
}
@media(max-width:576px) { .pv-title { font-size: 22px; } }

.pv-meta-list {
    border-top: 1px solid #f1f5f9;
    border-bottom: 1px solid #f1f5f9;
    padding: 14px 0;
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.pv-meta-row { display: flex; align-items: center; gap: 12px; }
.pv-meta-label { font-size: 13px; color: #94a3b8; min-width: 110px; font-weight: 500; }
.pv-meta-value { font-size: 14px; color: #1e293b; font-weight: 500; }
.pv-brand-link { color: #2563eb; text-decoration: none; }
.pv-brand-link:hover { text-decoration: underline; }
.pv-catalog {
    font-family: 'Courier New', monospace;
    background: #f1f5f9;
    padding: 2px 10px;
    border-radius: 6px;
    font-size: 13px;
}

.pv-short-desc {
    font-size: 15px;
    color: #475569;
    line-height: 1.7;
    margin-bottom: 24px;
    padding: 16px;
    background: #f8fafc;
    border-radius: 10px;
    border-left: 3px solid #2563eb;
}

.pv-cta { display: flex; flex-direction: column; gap: 10px; margin-bottom: 20px; }
.pv-btn-primary {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    background: linear-gradient(135deg, #1a1f2e, #2563eb);
    color: #fff;
    border: none;
    border-radius: 12px;
    padding: 14px 24px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: opacity .2s, transform .2s;
}
.pv-btn-primary:hover { opacity: .9; transform: translateY(-1px); color: #fff; text-decoration: none; }
.pv-btn-outline {
    display: block;
    text-align: center;
    border: 2px solid #1a1f2e;
    color: #1a1f2e;
    border-radius: 12px;
    padding: 12px 24px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: all .2s;
}
.pv-btn-outline:hover { background: #1a1f2e; color: #fff; text-decoration: none; }

.pv-footer-actions { margin-top: 16px; }
.pv-back-link { font-size: 13.5px; color: #64748b; text-decoration: none; }
.pv-back-link:hover { color: #2563eb; }

/* Tabs */
.pv-tabs-section { padding: 0 0 60px; background: #f8fafc; }
.pv-tabs-section .container { padding-top: 0; }
.pv-tabs {
    display: flex;
    gap: 0;
    border-bottom: 2px solid #e2e8f0;
    margin-bottom: 28px;
    padding-top: 32px;
}
.pv-tab-btn {
    background: none;
    border: none;
    border-bottom: 2px solid transparent;
    margin-bottom: -2px;
    padding: 12px 24px;
    font-size: 14px;
    font-weight: 600;
    color: #64748b;
    cursor: pointer;
    transition: all .2s;
    display: flex;
    align-items: center;
    gap: 8px;
}
.pv-tab-btn:hover { color: #1e293b; }
.pv-tab-btn.active { color: #2563eb; border-bottom-color: #2563eb; }
.pv-tab-badge {
    background: #2563eb;
    color: #fff;
    font-size: 11px;
    border-radius: 20px;
    padding: 1px 7px;
    font-weight: 600;
}

.pv-tab-content { display: none; }
.pv-tab-content.active { display: block; }

.pv-description {
    font-size: 15px;
    line-height: 1.85;
    color: #374151;
    max-width: 800px;
}
.pv-description h1,.pv-description h2,.pv-description h3 {
    font-weight: 700; color: #1e293b; margin-top: 24px;
}
.pv-description p { margin-bottom: 14px; }
.pv-description ul, .pv-description ol { padding-left: 20px; margin-bottom: 14px; }

/* Reviews */
.pv-reviews-list { display: flex; flex-direction: column; gap: 16px; margin-bottom: 32px; }
.pv-review-item {
    background: #fff;
    border: 1px solid #e8ecf0;
    border-radius: 12px;
    padding: 18px 20px;
}
.pv-review-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 10px;
    flex-wrap: wrap;
}
.pv-review-avatar {
    width: 38px;
    height: 38px;
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 700;
    flex-shrink: 0;
}
.pv-review-name { font-size: 14px; font-weight: 600; color: #1e293b; }
.pv-review-date { font-size: 12px; color: #94a3b8; }
.pv-review-stars { margin-left: auto; font-size: 16px; }
.star-fill { color: #f59e0b; }
.star-empty { color: #e2e8f0; }
.pv-review-text { font-size: 14px; color: #475569; margin: 0; line-height: 1.6; }
.pv-no-reviews { color: #94a3b8; font-size: 14px; padding: 16px 0; }

.pv-review-form-wrap {
    background: #fff;
    border: 1px solid #e8ecf0;
    border-radius: 14px;
    padding: 24px;
    margin-top: 24px;
    max-width: 600px;
}
.pv-review-form-title { font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 16px; }
.pv-review-form { display: flex; flex-direction: column; gap: 12px; }
.pv-form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
@media(max-width:576px) { .pv-form-row { grid-template-columns: 1fr; } }
.pv-input {
    width: 100%;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 14px;
    color: #1e293b;
    transition: border-color .2s;
    background: #f8fafc;
    outline: none;
}
.pv-input:focus { border-color: #2563eb; background: #fff; box-shadow: 0 0 0 3px rgba(37,99,235,.08); }
.pv-textarea { resize: vertical; min-height: 100px; }
</style>

<script>
function pvSetImg(src, el) {
    document.getElementById('pvMainImg').src = src;
    document.querySelectorAll('.pv-thumb').forEach(function(t) { t.classList.remove('active'); });
    el.classList.add('active');
}

function pvTab(btn, id) {
    document.querySelectorAll('.pv-tab-btn').forEach(function(b) { b.classList.remove('active'); });
    document.querySelectorAll('.pv-tab-content').forEach(function(c) { c.classList.remove('active'); });
    btn.classList.add('active');
    document.getElementById(id).classList.add('active');
}

document.getElementById('review-form').addEventListener('submit', function(e) {
    e.preventDefault();
    var form = this;
    var data = new FormData(form);
    data.append('_csrf', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

    fetch('/product/add-review', {
        method: 'POST',
        body: new URLSearchParams(data),
        headers: { 'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
    })
    .then(function(r) { return r.json(); })
    .then(function(res) {
        if (res.success) {
            var list = document.getElementById('review-list');
            if (!list) {
                list = document.createElement('div');
                list.id = 'review-list';
                list.className = 'pv-reviews-list';
                document.querySelector('.pv-review-form-wrap').before(list);
            }
            list.insertAdjacentHTML('afterbegin', res.html);
            form.reset();
        }
    });
});
</script>
