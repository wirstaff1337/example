<?php

use yii\helpers\Html;

/* @var $model app\models\Book */
?>

<div class="book-item">
    <h3><?= Html::encode($model->title) ?></h3>
    <p>Год выпуска: <?= Html::encode($model->year) ?></p>
    <p>ISBN: <?= Html::encode($model->isbn) ?></p>
    <p>Описание: <?= nl2br(Html::encode($model->description)) ?></p>
    <p>Авторы: <?= implode(', ', array_map(function($author) {
            return Html::encode($author->name);
        }, $model->authors)) ?></p>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить эту книгу?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>