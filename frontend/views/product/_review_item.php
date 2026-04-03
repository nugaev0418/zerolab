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