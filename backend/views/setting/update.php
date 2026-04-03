<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Setting $model */

$this->title = Yii::t('app', 'Update Setting', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Settings'), 'url' => ['']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="setting-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
