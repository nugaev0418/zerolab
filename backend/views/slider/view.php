<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Slider $model */

$lang = substr(Yii::$app->language, 0, 2);

$this->title = $model->getTitle() ?: '#' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sliders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\yii\web\YiiAsset::register($this);
?>
<div class="slider-view">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">
            <i class="bi bi-image me-2 text-primary"></i><?= Html::encode($this->title) ?>
        </h2>
        <div>
            <?= Html::a('<i class="bi bi-pencil me-1"></i>' . Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<i class="bi bi-trash me-1"></i>' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger ms-2',
                'data'  => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method'  => 'post',
                ],
            ]) ?>
        </div>
    </div>

    <div class="row g-4">

        <!-- Image + settings -->
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header bg-light"><i class="bi bi-image me-1"></i><?= Yii::t('app', 'Image') ?></div>
                <div class="card-body text-center">
                    <?php if ($model->image): ?>
                        <img src="/upload/slider/<?= Html::encode($model->image) ?>"
                             class="img-fluid rounded" style="max-height:200px;object-fit:cover;">
                    <?php else: ?>
                        <div class="text-muted py-4"><i class="bi bi-image fs-1"></i><br><?= Yii::t('app', 'No image') ?></div>
                    <?php endif; ?>
                </div>
                <div class="card-footer">
                    <table class="table table-sm mb-0">
                        <tr>
                            <td class="text-muted"><?= Yii::t('app', 'Status') ?></td>
                            <td>
                                <?= $model->status
                                    ? '<span class="badge bg-success">' . Yii::t('app', 'Active') . '</span>'
                                    : '<span class="badge bg-secondary">' . Yii::t('app', 'Inactive') . '</span>' ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted"><?= Yii::t('app', 'Sort') ?></td>
                            <td><?= Html::encode($model->sort_order) ?></td>
                        </tr>
                        <?php if ($model->url): ?>
                            <tr>
                                <td class="text-muted"><?= Yii::t('app', 'URL') ?></td>
                                <td><?= Html::a(Html::encode($model->url), $model->url, ['target' => '_blank', 'class' => 'text-truncate d-inline-block', 'style' => 'max-width:160px']) ?></td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>

        <!-- Translations -->
        <div class="col-md-8">
            <div class="card h-100">
                <div class="card-header bg-light"><i class="bi bi-translate me-1"></i><?= Yii::t('app', 'Translations') ?></div>
                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <?php foreach (['uz' => 'UZ', 'ru' => 'RU', 'en' => 'EN'] as $code => $label): ?>
                            <li class="nav-item">
                                <button type="button"
                                        class="nav-link <?= $lang === $code ? 'active' : '' ?>"
                                        data-bs-toggle="tab"
                                        data-bs-target="#view-tab-<?= $code ?>">
                                    <?= $label ?>
                                </button>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="tab-content mt-3">
                        <?php foreach (['uz' => 'UZ', 'ru' => 'RU', 'en' => 'EN'] as $code => $label): ?>
                            <div class="tab-pane fade <?= $lang === $code ? 'show active' : '' ?>" id="view-tab-<?= $code ?>">
                                <div class="mb-3">
                                    <div class="text-muted small mb-1"><?= Yii::t('app', 'Title') ?></div>
                                    <div class="fw-semibold fs-5"><?= Html::encode($model->{'title_' . $code}) ?: '<span class="text-muted">—</span>' ?></div>
                                </div>
                                <div>
                                    <div class="text-muted small mb-1"><?= Yii::t('app', 'Text') ?></div>
                                    <div><?= nl2br(Html::encode($model->{'text_' . $code})) ?: '<span class="text-muted">—</span>' ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
