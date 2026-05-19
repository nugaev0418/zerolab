<?php
/** @var yii\web\View $this */
/** @var \frontend\models\ContactForm $model */

use common\models\Setting;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::t('app', 'Contact');
?>

<style>
/* ── Contact page ── */
.contact-section {
    padding: 60px 0 80px;
}
.contact-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 32px rgba(0,0,0,.07);
}
@media (max-width: 900px) {
    .contact-grid { grid-template-columns: 1fr; }
}
.contact-map iframe {
    display: block;
    width: 100%;
    height: 100%;
    min-height: 420px;
    border: 0;
}
.contact-info {
    background: #1e293b;
    color: #e2e8f0;
    padding: 48px 40px;
    display: flex;
    flex-direction: column;
    gap: 28px;
}
@media (max-width: 600px) { .contact-info { padding: 36px 24px; } }
.contact-info-title {
    font-size: 1.35rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 4px;
}
.contact-info-row {
    display: flex;
    align-items: flex-start;
    gap: 14px;
}
.contact-info-icon {
    flex-shrink: 0;
    width: 38px;
    height: 38px;
    background: rgba(255,255,255,.08);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #93c5fd;
}
.contact-info-label {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: .07em;
    color: #64748b;
    margin-bottom: 2px;
}
.contact-info-value {
    font-size: 0.95rem;
    color: #e2e8f0;
}
.contact-info-value a {
    color: #93c5fd;
    text-decoration: none;
}
.contact-info-value a:hover { color: #bfdbfe; }
.contact-socials {
    display: flex;
    gap: 10px;
    margin-top: 4px;
}
.contact-social-btn {
    width: 38px;
    height: 38px;
    border-radius: 8px;
    background: rgba(255,255,255,.08);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #93c5fd;
    text-decoration: none;
    transition: background .2s, color .2s;
}
.contact-social-btn:hover { background: #2563eb; color: #fff; }

/* Form section */
.contact-form-section {
    padding: 60px 0 80px;
    background: #f8fafc;
}
.contact-form-inner {
    max-width: 600px;
    margin: 0 auto;
    background: #fff;
    border-radius: 16px;
    padding: 48px 40px;
    box-shadow: 0 4px 24px rgba(0,0,0,.06);
}
@media (max-width: 600px) { .contact-form-inner { padding: 32px 20px; } }
.contact-form-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 8px;
}
.contact-form-sub {
    color: #64748b;
    font-size: 0.9rem;
    margin-bottom: 32px;
}
.contact-form-inner .form-control,
.contact-form-inner .form-select {
    border-radius: 8px;
    border-color: #e2e8f0;
    padding: 10px 14px;
    font-size: 0.9rem;
    background: #f8fafc;
}
.contact-form-inner .form-control:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,.12);
    background: #fff;
}
.contact-form-inner .form-label {
    font-size: 0.85rem;
    font-weight: 600;
    color: #374151;
}
.btn-contact-submit {
    width: 100%;
    padding: 13px;
    background: #2563eb;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    transition: background .2s;
    margin-top: 8px;
}
.btn-contact-submit:hover { background: #1d4ed8; }
</style>

<div class="page-hero">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="breadcrumb-hero">
            <a href="/"><?= Yii::t('app', 'Home page') ?></a>
            <span>›</span>
            <span><?= Html::encode($this->title) ?></span>
        </div>
    </div>
</div>

<!-- Map + Info -->
<section class="contact-section">
    <div class="container">
        <div class="contact-grid">
            <div class="contact-map">
                <?php $location = Setting::get('location'); ?>
                <?php if ($location): ?>
                    <iframe src="<?= Html::encode($location) ?>"
                            allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                <?php else: ?>
                    <div style="width:100%;min-height:420px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;color:#94a3b8;">
                        <svg width="48" height="48" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                    </div>
                <?php endif; ?>
            </div>

            <div class="contact-info">
                <div class="contact-info-title"><?= Yii::t('app', 'Visit Our Store') ?></div>

                <?php if ($addr = Setting::get('address')): ?>
                <div class="contact-info-row">
                    <div class="contact-info-icon">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="contact-info-label"><?= Yii::t('app', 'Address') ?></div>
                        <div class="contact-info-value"><?= Html::encode($addr) ?></div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($phone = Setting::get('phone')): ?>
                <div class="contact-info-row">
                    <div class="contact-info-icon">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="contact-info-label"><?= Yii::t('app', 'Phone') ?></div>
                        <div class="contact-info-value"><a href="tel:<?= Html::encode($phone) ?>"><?= Html::encode($phone) ?></a></div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($email = Setting::get('email')): ?>
                <div class="contact-info-row">
                    <div class="contact-info-icon">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="contact-info-label">Email</div>
                        <div class="contact-info-value"><a href="mailto:<?= Html::encode($email) ?>"><?= Html::encode($email) ?></a></div>
                    </div>
                </div>
                <?php endif; ?>

                <div>
                    <div class="contact-info-label" style="margin-bottom:10px;"><?= Yii::t('app', 'Social networks') ?></div>
                    <div class="contact-socials">
                        <?php if ($tg = Setting::get('telegram')): ?>
                        <a href="<?= Html::encode($tg) ?>" target="_blank" class="contact-social-btn" title="Telegram">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.287 5.906q-1.168.486-4.666 2.01-.567.225-.595.442c-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294q.39.01.868-.32 3.269-2.206 3.374-2.23c.05-.012.12-.026.166.016s.042.12.037.141c-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8 8 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629q.14.092.27.187c.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.4 1.4 0 0 0-.013-.315.34.34 0 0 0-.114-.217.53.53 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09"/>
                            </svg>
                        </a>
                        <?php endif; ?>
                        <?php if ($ig = Setting::get('instagram')): ?>
                        <a href="<?= Html::encode($ig) ?>" target="_blank" class="contact-social-btn" title="Instagram">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm.003 1.44c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                            </svg>
                        </a>
                        <?php endif; ?>
                        <?php if ($fb = Setting::get('facebook')): ?>
                        <a href="<?= Html::encode($fb) ?>" target="_blank" class="contact-social-btn" title="Facebook">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                            </svg>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form -->
<section class="contact-form-section">
    <div class="container">
        <div class="contact-form-inner">
            <div class="contact-form-title"><?= Yii::t('app', 'Get in Touch') ?></div>
            <p class="contact-form-sub"><?= Yii::t('app', 'Fill out the form and we will contact you shortly') ?></p>

            <?php $form = ActiveForm::begin([
                'id'     => 'contact-form',
                'options' => ['novalidate' => true],
                'fieldConfig' => [
                    'template'     => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'form-label'],
                    'inputOptions' => ['class' => 'form-control'],
                    'errorOptions' => ['class' => 'invalid-feedback', 'tag' => 'div'],
                ],
            ]); ?>

            <?= $form->field($model, 'name')->textInput(['placeholder' => Yii::t('app', 'Your name')]) ?>
            <?= $form->field($model, 'email')->input('email', ['placeholder' => 'email@example.com']) ?>
            <?= $form->field($model, 'subject')->textInput(['placeholder' => Yii::t('app', 'Subject')]) ?>
            <?= $form->field($model, 'body')->textarea(['rows' => 5, 'placeholder' => Yii::t('app', 'Your message')]) ?>

            <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                'template' => '<div style="display:flex;align-items:center;gap:12px;">{image}<div style="flex:1">{input}</div></div>',
            ]) ?>

            <button type="submit" class="btn-contact-submit"><?= Yii::t('app', 'Submit') ?></button>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>
