<?php

use yii\helpers\Html;

/* @var $model app\models\Author */
?>

<div class="author-item">
    <h3><?= Html::encode($model->name) ?></h3>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этого автора?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>