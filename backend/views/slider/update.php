<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Slider $model */

$this->title = Yii::t('app', 'Update Slider') . ': ' . ($model->getTitle() ?: '#' . $model->id);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sliders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->getTitle() ?: '#' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="slider-update">

    <div class="d-flex align-items-center gap-2 mb-4">
        <i class="bi bi-pencil-square fs-4 text-primary"></i>
        <h2 class="mb-0"><?= Html::encode($this->title) ?></h2>
    </div>

    <?= $this->render('_form', ['model' => $model]) ?>

</div>
