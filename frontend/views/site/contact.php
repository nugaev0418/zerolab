<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ContactForm $model */

use common\models\Setting;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::t('app', 'Contact');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">

    <div class="tf-page-title style-2">
        <div class="container-full">
            <div class="heading text-center"><?= Html::encode($this->title) ?></div>
        </div>
    </div>

<!--    MAP -->
    <section class="flat-spacing-9">
        <div class="container">
            <div class="tf-grid-layout gap-0 lg-col-2">
                <div class="w-100">

                    <iframe src="https://www.google.com/maps/embed?pb=!1m13!1m8!1m3!1d1497.7711303762162!2d69.29637812466106!3d41.34056594258292!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNDHCsDIwJzI2LjQiTiA2OcKwMTcnNDkuMiJF!5e0!3m2!1suz!2s!4v1775632312943!5m2!1suz!2s" width="100%" height="700" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="tf-content-left has-mt">
                    <div class="sticky-top">
                        <h5 class="mb_20">
                            <?= Yii::t('app', 'Visit Our Store') ?>
                        </h5>
                        <div class="mb_20">
                            <p class="mb_15"><strong>
                                    <?= Yii::t('app', 'Address') ?>
                                </strong></p>
                            <p><?= Setting::get('address')?></p>
                        </div>
                        <div class="mb_20">
                            <p class="mb_15"><strong>
                                    <?= Yii::t('app', 'Phone') ?>
                                </strong></p>
                            <p><a href="tel:<?= Setting::get('phone')?>">
                                    <?= Setting::get('phone')?>
                                </a></p>
                        </div>
                        <div class="mb_20">
                            <p class="mb_15"><strong>Email</strong></p>
                            <p><a href="mailto:<?= Setting::get('email')?>"><?= Setting::get('email')?></a></p>
                        </div>
                        <div>
                            <ul class="tf-social-icon d-flex gap-20 style-default">
                                <li><a href="#" class="box-icon link round social-facebook border-line-black"><i class="icon fs-14 icon-fb"></i></a></li>
                                <li><a href="#" class="box-icon link round social-twiter border-line-black"><i class="icon fs-12 icon-Icon-x"></i></a></li>
                                <li><a href="#" class="box-icon link round social-instagram border-line-black"><i class="icon fs-14 icon-instagram"></i></a></li>
                                <li><a href="#" class="box-icon link round social-tiktok border-line-black"><i class="icon fs-14 icon-tiktok"></i></a></li>
                                <li><a href="#" class="box-icon link round social-pinterest border-line-black"><i class="icon fs-14 icon-pinterest-1"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!--    END MAP-->

<!--    FORM-->
    <section class="bg_grey-7 flat-spacing-9">
        <div class="container">
            <div class="flat-title">
                <span class="title">
                    <?= Yii::t('app', 'Get in Touch') ?>
                </span>
                <p class="sub-title text_black-2"></p>
            </div>
            <div>

                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                        <?= $form->field($model, 'name')->textInput() ?>

                        <?= $form->field($model, 'email') ?>

                        <?= $form->field($model, 'subject') ?>

                        <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                        <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                        ]) ?>

                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>

            </div>
        </div>
    </section>
<!--    END FORM-->
