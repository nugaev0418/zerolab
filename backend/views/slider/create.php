<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Slider $model */

$this->title = Yii::t('app', 'Create Slider');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sliders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-create">

    <div class="d-flex align-items-center gap-2 mb-4">
        <i class="bi bi-plus-circle fs-4 text-success"></i>
        <h2 class="mb-0"><?= Html::encode($this->title) ?></h2>
    </div>

    <?= $this->render('_form', ['model' => $model]) ?>

</div>
