<?php
use yii\helpers\Html;
use yii\helpers\Url;

$lang = Yii::$app->language;

$this->title = $model->{'meta_title_' . $lang} ?: $model->{'name_' . $lang};
?>



<section class="flat-spacing-4 pt_0 mt-5">
    <div class="tf-main-product section-image-zoom">
        <div class="container">
            <div class="row">
                <div class="col-md-6">

                    <img id="mainImage"
                         src="/upload/product/<?= $model->image ?>"
                         class="img-fluid border mb-3">

                    <div class="d-flex gap-2 flex-wrap">

                        <?php foreach ($model->images as $img): ?>
                            <img src="/upload/product/<?= $img->image ?>"
                                 width="80"
                                 style="cursor:pointer;border:1px solid #ddd;"
                                 onclick="document.getElementById('mainImage').src=this.src">
                        <?php endforeach; ?>

                    </div>

                </div>
                <div class="col-md-6">
                    <div class="tf-product-info-wrap position-relative">
                        <div class="tf-zoom-main"></div>
                        <div class="tf-product-info-list other-image-zoom">
                            <div class="tf-product-info-title">
                                <h4><?= Html::encode($model->{'name_' . $lang}) ?></h4>
                            </div>
                            <div class="tf-product-info-badges">
                                Brand
                                <div class="badges"><strong>
                                        <?= Html::a(
                                                $model->brand->{'name_' . $lang},
                                                ['brand/view', 'slug' => $model->brand->slug]
                                        ) ?>
                                    </strong></div>
                            </div>



                            <div>
                                <p>Catalog Number: <?= Html::encode($model->catalog_number) ?></p>
                            </div>

                            <div>
                                <b>Short Desc:</b>
                                <p><?= Html::encode($model->{'short_description_' . $lang}) ?></p>
                            </div>


                            <div class="tf-product-info-buy-button">
                                <form class="">
                                    <a href="#" class="tf-btn btn-fill justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn btn-add-to-cart"><span>Narxini bilish</span></a>

                                    <div class="w-100">
                                        <a href="#" class="btns-full">Telegram kanal</a>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

</section>

<section class="flat-spacing-17 pt_0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="widget-tabs style-has-border">
                    <ul class="widget-menu-tab">
                        <li class="item-title active">
                            <span class="inner">Description</span>
                        </li>

                        <li class="item-title">
                            <span class="inner">Review</span>
                        </li>

                    </ul>
                    <div class="widget-content-tab">
                        <div class="widget-content-inner active">
                            <div>

                                <p class="mb_30">
                                    <?= $model->getDescription() ?>
                                </p>

                            </div>
                        </div>
                        <div class="widget-content-inner">
                            <div class="tab-reviews write-cancel-review-wrap">
                                <div class="tab-reviews-heading">
                                    <div class="top">
                                        <div class="text-center">
                                            <?php
                                            $reviews = $model->reviews;
                                            $count = count($reviews);
                                            $avg = $count ? array_sum(array_column($reviews, 'rating')) / $count : 0;
                                            ?>

                                            <h1 class="number fw-6">
                                                <?= number_format($avg, 1) ?>
                                            </h1>

                                            <p>(<?= $count ?> Reviews)</p>
                                        </div>
                                        <div class="rating-score">
                                            <div class="item">
                                                <div class="number-1 text-caption-1">5</div>
                                                <i class="icon icon-star"></i>
                                                <div class="line-bg">
                                                    <div style="width: 94.67%;"></div>
                                                </div>
                                                <div class="number-2 text-caption-1">59</div>
                                            </div>
                                            <div class="item">
                                                <div class="number-1 text-caption-1">4</div>
                                                <i class="icon icon-star"></i>
                                                <div class="line-bg">
                                                    <div style="width: 60%;"></div>
                                                </div>
                                                <div class="number-2 text-caption-1">46</div>
                                            </div>
                                            <div class="item">
                                                <div class="number-1 text-caption-1">3</div>
                                                <i class="icon icon-star"></i>
                                                <div class="line-bg">
                                                    <div style="width: 0%;"></div>
                                                </div>
                                                <div class="number-2 text-caption-1">0</div>
                                            </div>
                                            <div class="item">
                                                <div class="number-1 text-caption-1">2</div>
                                                <i class="icon icon-star"></i>
                                                <div class="line-bg">
                                                    <div style="width: 0%;"></div>
                                                </div>
                                                <div class="number-2 text-caption-1">0</div>
                                            </div>
                                            <div class="item">
                                                <div class="number-1 text-caption-1">1</div>
                                                <i class="icon icon-star"></i>
                                                <div class="line-bg">
                                                    <div style="width: 0%;"></div>
                                                </div>
                                                <div class="number-2 text-caption-1">0</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="tf-btn btn-outline-dark fw-6 btn-comment-review btn-cancel-review">
                                            Cancel Review</div>
                                        <div class="tf-btn btn-outline-dark fw-6 btn-comment-review btn-write-review">
                                            Write a review</div>
                                    </div>
                                </div>
                                <div class="reply-comment cancel-review-wrap">
                                    <div class="d-flex mb_24 gap-20 align-items-center justify-content-between flex-wrap">
                                        <h5 class="">03 Comments</h5>
                                        <div class="d-flex align-items-center gap-12">
                                            <div class="text-caption-1">Sort by:</div>
                                            <div class="tf-dropdown-sort" data-bs-toggle="dropdown">
                                                <div class="btn-select">
                                                    <span class="text-sort-value">Most Recent</span>
                                                    <span class="icon icon-arrow-down"></span>
                                                </div>
                                                <div class="dropdown-menu">
                                                    <div class="select-item active">
                                                        <span class="text-value-item">Most Recent</span>
                                                    </div>
                                                    <div class="select-item">
                                                        <span class="text-value-item">Oldest</span>
                                                    </div>
                                                    <div class="select-item">
                                                        <span class="text-value-item">Most Popular</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="reply-comment-wrap">
                                        <?php foreach ($reviews as $review): ?>

                                            <div class="reply-comment-item">

                                                <div class="user">
                                                    <div>
                                                        <h6><?= $review->full_name ?></h6>
                                                        <div class="day">
                                                            <?= Yii::$app->formatter->asRelativeTime($review->created_at) ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <p><?= $review->review ?></p>

                                            </div>

                                        <?php endforeach; ?>
                                    </div>

                                </div>
                                <form id="review-form" class="form-write-review write-review-wrap">

                                    <input type="hidden" class="form-control mt-2" name="product_id" value="<?= $model->id ?>">

                                    <input type="text" class="form-control mt-2" name="full_name" placeholder="Your name" required>

                                    <textarea name="review" class="form-control mt-2" placeholder="Your review" required></textarea>

                                    <select name="rating" class="form-control mt-2">
                                        <option value="5">5</option>
                                        <option value="4">4</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                    </select>

                                    <button type="submit" class="tf-btn btn-fill mt-2">
                                        Submit
                                    </button>

                                </form>





                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<?php
$this->registerJs(<<<JS

$('#review-form').on('submit', function(e){
    e.preventDefault();

    let form = $(this);

    $.ajax({
        url: '/product/add-review',
        type: 'POST',
        data: form.serialize(),
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(res){

            if(res.success){
                $('#review-list').prepend(res.html);
                form[0].reset();
            } else {
                console.log(res.errors);
            }

        },
        error: function(xhr){
            console.log(xhr.responseText);
            alert('Server error');
        }
    });
});

JS);
