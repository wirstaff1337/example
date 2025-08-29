<?php

use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'Список книг';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить новую книгу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_book_item', // Отображение для каждой книги
]); ?>