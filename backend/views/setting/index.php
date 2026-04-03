<?php

use common\models\Setting;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\SettingSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Setting'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'site_name_uz',
            'site_name_ru',
            'site_name_en',
            'about_title_uz',
            //'about_title_ru',
            //'about_title_en',
            //'about_content_uz:ntext',
            //'about_content_ru:ntext',
            //'about_content_en:ntext',
            //'address_uz:ntext',
            //'address_ru:ntext',
            //'address_en:ntext',
            //'phone',
            //'email:email',
            //'telegram',
            //'instagram',
            //'facebook',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Setting $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
