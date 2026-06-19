<?php

use common\models\Slider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var backend\models\SliderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Sliders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-index">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">
            <i class="bi bi-images me-2 text-primary"></i><?= Html::encode($this->title) ?>
        </h2>
        <?= Html::a(
            '<i class="bi bi-plus-lg me-1"></i>' . Yii::t('app', 'Create Slider'),
            ['create'],
            ['class' => 'btn btn-success']
        ) ?>
    </div>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'tableOptions' => ['class' => 'table table-hover align-middle'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'image',
                'label'     => Yii::t('app', 'Image'),
                'filter'    => false,
                'format'    => 'raw',
                'value'     => function (Slider $model) {
                    if ($model->image) {
                        return Html::img(
                            '/upload/slider/' . $model->image,
                            ['style' => 'height:56px;width:100px;object-fit:cover;border-radius:6px;']
                        );
                    }
                    return '<span class="text-muted">—</span>';
                },
            ],

            [
                'attribute' => 'title_uz',
                'label'     => Yii::t('app', 'Title'),
                'format'    => 'raw',
                'value'     => function (Slider $model) {
                    $title = Html::encode($model->getTitle());
                    return '<strong>' . ($title ?: '<span class="text-muted">—</span>') . '</strong>';
                },
            ],

            [
                'attribute' => 'status',
                'label'     => Yii::t('app', 'Status'),
                'filter'    => [1 => Yii::t('app', 'Active'), 0 => Yii::t('app', 'Inactive')],
                'format'    => 'raw',
                'value'     => function (Slider $model) {
                    return $model->status
                        ? '<span class="badge bg-success">' . Yii::t('app', 'Active') . '</span>'
                        : '<span class="badge bg-secondary">' . Yii::t('app', 'Inactive') . '</span>';
                },
            ],

            [
                'attribute' => 'sort_order',
                'label'     => Yii::t('app', 'Sort'),
            ],

            [
                'class'      => ActionColumn::class,
                'urlCreator' => function ($action, Slider $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'template'   => '{update} {delete}',
                'buttons'    => [
                    'update' => function ($url, $model) {
                        return Html::a('<i class="bi bi-pencil"></i>', $url, [
                            'class' => 'btn btn-sm btn-outline-primary',
                            'title' => Yii::t('app', 'Update'),
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="bi bi-trash"></i>', $url, [
                            'class' => 'btn btn-sm btn-outline-danger',
                            'title' => Yii::t('app', 'Delete'),
                            'data'  => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method'  => 'post',
                            ],
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
