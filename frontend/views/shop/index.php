<?php
use yii\helpers\Html;
use yii\helpers\Url;

$lang = Yii::$app->language;
$this->title = Yii::t('app', 'Products');

$totalCount = $dataProvider->getTotalCount();
$hasFilters  = !empty($selectedCategories) || !empty($selectedBrands) || !empty($selectedDirections);
?>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="breadcrumb-hero">
            <a href="/"><?= Yii::t('app', 'Home page') ?></a>
            <span>›</span>
            <span><?= Html::encode($this->title) ?></span>
        </div>
    </div>
</div>

<div class="container">
    <div class="shop-layout">

        <!-- ===== SIDEBAR FILTER ===== -->
        <aside class="shop-sidebar" id="shopSidebar">

            <?php
            $filterUrl = Url::to(['shop/index']);
            ?>

            <form method="get" action="<?= $filterUrl ?>" id="filterForm">

                <!-- Category -->
                <?php if (!empty($categories)): ?>
                <div class="filter-card">
                    <div class="filter-card-header" onclick="toggleFilter(this)">
                        <h6><?= Yii::t('app', 'Categories') ?></h6>
                        <span class="toggle-icon">▼</span>
                    </div>
                    <div class="filter-card-body">
                        <?php foreach ($categories as $cat): ?>
                            <?php $checked = in_array($cat->id, (array)$selectedCategories); ?>
                            <label class="filter-check-item <?= $checked ? 'checked' : '' ?>">
                                <input type="checkbox" name="category[]"
                                       value="<?= $cat->id ?>"
                                       <?= $checked ? 'checked' : '' ?>
                                       onchange="document.getElementById('filterForm').submit()">
                                <label><?= Html::encode($cat->getName()) ?>
                                    <span class="count"><?= $cat->getProducts()->count() ?></span>
                                </label>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Direction -->
                <?php if (!empty($directions)): ?>
                <div class="filter-card">
                    <div class="filter-card-header" onclick="toggleFilter(this)">
                        <h6><?= Yii::t('app', 'Направления') ?></h6>
                        <span class="toggle-icon">▼</span>
                    </div>
                    <div class="filter-card-body">
                        <?php foreach ($directions as $dir): ?>
                            <?php $checked = in_array($dir->id, (array)$selectedDirections); ?>
                            <label class="filter-check-item <?= $checked ? 'checked' : '' ?>">
                                <input type="checkbox" name="direction[]"
                                       value="<?= $dir->id ?>"
                                       <?= $checked ? 'checked' : '' ?>
                                       onchange="document.getElementById('filterForm').submit()">
                                <label><?= Html::encode($dir->getName()) ?>
                                    <span class="count"><?= $dir->getProducts()->count() ?></span>
                                </label>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Brand -->
                <?php if (!empty($brands)): ?>
                <div class="filter-card">
                    <div class="filter-card-header" onclick="toggleFilter(this)">
                        <h6><?= Yii::t('app', 'Brands') ?></h6>
                        <span class="toggle-icon">▼</span>
                    </div>
                    <div class="filter-card-body">
                        <?php foreach ($brands as $brand): ?>
                            <?php $checked = in_array($brand->id, (array)$selectedBrands); ?>
                            <label class="filter-check-item <?= $checked ? 'checked' : '' ?>">
                                <input type="checkbox" name="brand[]"
                                       value="<?= $brand->id ?>"
                                       <?= $checked ? 'checked' : '' ?>
                                       onchange="document.getElementById('filterForm').submit()">
                                <label><?= Html::encode($brand->getName()) ?>
                                    <span class="count"><?= count($brand->products) ?></span>
                                </label>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($hasFilters): ?>
                    <a href="<?= $filterUrl ?>" class="btn-clear-filters">
                        ✕ <?= Yii::t('app', 'Clear filters') ?>
                    </a>
                <?php endif; ?>

            </form>
        </aside>
        <!-- ===== /SIDEBAR ===== -->

        <!-- ===== PRODUCTS AREA ===== -->
        <div class="shop-content">

            <!-- Toolbar -->
            <div class="shop-toolbar">
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <button class="btn-mobile-filter" onclick="toggleMobileSidebar()">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                        <?= Yii::t('app', 'Filters') ?>
                        <?php if ($hasFilters): ?>
                            <span style="background:#2563eb;border-radius:50%;width:18px;height:18px;display:inline-flex;align-items:center;justify-content:center;font-size:11px;">
                                <?= (count((array)$selectedCategories) + count((array)$selectedBrands) + count((array)$selectedDirections)) ?>
                            </span>
                        <?php endif; ?>
                    </button>
                    <span class="shop-count">
                        <strong><?= $totalCount ?></strong> <?= Yii::t('app', 'products found') ?>
                    </span>
                </div>

                <form method="get" action="<?= $filterUrl ?>" id="sortForm">
                    <?php foreach ((array)$selectedCategories as $id): ?>
                        <input type="hidden" name="category[]" value="<?= (int)$id ?>">
                    <?php endforeach; ?>
                    <?php foreach ((array)$selectedDirections as $id): ?>
                        <input type="hidden" name="direction[]" value="<?= (int)$id ?>">
                    <?php endforeach; ?>
                    <?php foreach ((array)$selectedBrands as $id): ?>
                        <input type="hidden" name="brand[]" value="<?= (int)$id ?>">
                    <?php endforeach; ?>
                    <select class="sort-select" name="sort" onchange="document.getElementById('sortForm').submit()">
                        <option value=""><?= Yii::t('app', 'Default sort') ?></option>
                        <option value="name_asc"  <?= (Yii::$app->request->get('sort') === 'name_asc')  ? 'selected' : '' ?>>A → Z</option>
                        <option value="name_desc" <?= (Yii::$app->request->get('sort') === 'name_desc') ? 'selected' : '' ?>>Z → A</option>
                    </select>
                </form>
            </div>

            <!-- Active filter pills -->
            <?php if ($hasFilters): ?>
            <div class="active-filters mb-3">
                <?php foreach ((array)$selectedCategories as $id):
                    $cat = \common\models\Category::findOne($id);
                    if (!$cat) continue;
                    $removeUrl = Url::current(['category' => array_values(array_diff((array)$selectedCategories, [$id]))]);
                ?>
                    <span class="filter-pill">
                        <?= Html::encode($cat->getName()) ?>
                        <a href="<?= $removeUrl ?>">✕</a>
                    </span>
                <?php endforeach; ?>
                <?php foreach ((array)$selectedDirections as $id):
                    $dir = \common\models\Direction::findOne($id);
                    if (!$dir) continue;
                    $removeUrl = Url::current(['direction' => array_values(array_diff((array)$selectedDirections, [$id]))]);
                ?>
                    <span class="filter-pill">
                        <?= Html::encode($dir->getName()) ?>
                        <a href="<?= $removeUrl ?>">✕</a>
                    </span>
                <?php endforeach; ?>
                <?php foreach ((array)$selectedBrands as $id):
                    $brand = \common\models\Brand::findOne($id);
                    if (!$brand) continue;
                    $removeUrl = Url::current(['brand' => array_values(array_diff((array)$selectedBrands, [$id]))]);
                ?>
                    <span class="filter-pill">
                        <?= Html::encode($brand->getName()) ?>
                        <a href="<?= $removeUrl ?>">✕</a>
                    </span>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- Product Grid -->
            <div class="product-grid">
                <?php if ($dataProvider->getTotalCount() === 0): ?>
                    <div class="empty-state">
                        <svg width="64" height="64" fill="#94a3b8" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15v-4H7l5-8v4h4l-5 8z"/>
                        </svg>
                        <h4><?= Yii::t('app', 'No products found') ?></h4>
                        <p><?= Yii::t('app', 'Try changing your filter criteria') ?></p>
                        <a href="<?= $filterUrl ?>" class="btn-apply-filter" style="max-width:200px;margin:16px auto 0;display:block;">
                            <?= Yii::t('app', 'Clear filters') ?>
                        </a>
                    </div>
                <?php else: ?>
                    <?php foreach ($dataProvider->getModels() as $model): ?>
                        <?= $this->render('_product_card', ['model' => $model]) ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Pagination -->
            <?php if ($dataProvider->getPagination()->getPageCount() > 1): ?>
            <div class="pagination-wrap">
                <?= \yii\widgets\LinkPager::widget([
                    'pagination' => $dataProvider->getPagination(),
                    'options'    => ['class' => 'pagination'],
                    'linkOptions'      => ['class' => 'page-link'],
                    'activePageCssClass' => 'active',
                    'disabledPageCssClass' => 'disabled',
                    'pageCssClass' => 'page-item',
                    'firstPageLabel' => '«',
                    'lastPageLabel'  => '»',
                    'prevPageLabel'  => '‹',
                    'nextPageLabel'  => '›',
                ]) ?>
            </div>
            <?php endif; ?>

        </div>
        <!-- ===== /PRODUCTS ===== -->

    </div>
</div>

<!-- Mobile sidebar overlay -->
<div id="sidebarOverlayShop" onclick="toggleMobileSidebar()"
     style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:1040;"></div>

<script>
function toggleFilter(header) {
    var body = header.nextElementSibling;
    var icon = header.querySelector('.toggle-icon');
    if (body.style.display === 'none') {
        body.style.display = 'block';
        icon.style.transform = 'rotate(0deg)';
    } else {
        body.style.display = 'none';
        icon.style.transform = 'rotate(-90deg)';
    }
}

function toggleMobileSidebar() {
    var sidebar  = document.getElementById('shopSidebar');
    var overlay  = document.getElementById('sidebarOverlayShop');
    var isOpen   = sidebar.classList.toggle('mobile-open');
    overlay.style.display = isOpen ? 'block' : 'none';
    document.body.style.overflow = isOpen ? 'hidden' : '';
}
</script>
