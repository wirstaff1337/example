<?php

use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'Список авторов';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить нового автора', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_author_item',
]); ?>