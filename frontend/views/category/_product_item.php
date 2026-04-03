<?php
use yii\helpers\Html;
use yii\helpers\Url;

$lang = Yii::$app->language;
?>

<div class="card h-100 shadow-sm">

    <a href="<?= Url::to(['product/view', 'slug' => $model->slug]) ?>">
        <img src="/upload/product/<?= $model->image ?>"
             class="card-img-top"
             style="height:200px;object-fit:cover;">
    </a>

    <div class="card-body">

        <h6>
            <?= Html::a(
                Html::encode($model->{'name_' . $lang}),
                ['product/view', 'slug' => $model->slug]
            ) ?>
        </h6>

        <p class="small text-muted">
            <?= Html::encode($model->{'short_description_' . $lang}) ?>
        </p>

    </div>

</div>