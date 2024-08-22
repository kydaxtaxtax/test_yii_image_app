<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<h1>Admin Panel</h1>

<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Decision</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($decisions as $decision): ?>
        <tr>
            <td><?= Html::encode($decision->image_id) ?></td>
            <td><img src="https://picsum.photos/id/<?= Html::encode($decision->image_id) ?>/100/100" alt="Image"></td>
            <td><?= Html::encode($decision->decision) ?></td>
            <td>
                <?= Html::a('Delete', ['delete', 'id' => $decision->id, 'token' => Yii::$app->request->get('token')], [
                    'class' => 'btn btn-danger',
                    'data-method' => 'post',
                    'data-confirm' => 'Are you sure you want to delete this item?',
                ]) ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
