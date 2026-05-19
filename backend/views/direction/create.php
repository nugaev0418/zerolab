<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Direction $model */

$this->title = 'Направление qo\'shish';
$this->params['breadcrumbs'][] = ['label' => 'Направления', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="direction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model]) ?>

</div>