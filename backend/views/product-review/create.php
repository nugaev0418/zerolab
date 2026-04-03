<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ProductReview $model */

$this->title = Yii::t('app', 'Create Product Review');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Reviews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-review-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
