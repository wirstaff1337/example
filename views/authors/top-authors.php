<?php

use yii\helpers\Html;

$this->title = 'Топ авторов';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<table class="table table-striped">
    <thead>
    <tr>
        <th>ФИО Автора</th>
        <th>Количество книг</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($authors as $author): ?>
        <tr>
            <td><?= Html::encode($author->name) ?></td>
            <td><?= Html::encode(count($author->books)) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>