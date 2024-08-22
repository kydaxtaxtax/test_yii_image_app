<?php
use yii\helpers\Html;
use yii\web\JsExpression;

$this->title = 'Random Image';
?>

<div class="site-index">
    <h1>Random Image</h1>
    <img src="https://picsum.photos/id/<?= $imageId ?>/600/500" alt="Random Image">

    <div class="form-group">
        <?= Html::button('Approve', [
            'class' => 'btn btn-success',
            'onclick' => new JsExpression("
                $.post('/site/decision', {image_id: $imageId, decision: 'approved'})
                .done(function() {
                    location.reload();
                });
            ")
        ]) ?>
        <?= Html::button('Reject', [
            'class' => 'btn btn-danger',
            'onclick' => new JsExpression("
                $.post('/site/decision', {image_id: $imageId, decision: 'rejected'})
                .done(function() {
                    location.reload();
                });
            ")
        ]) ?>
    </div>
</div>
