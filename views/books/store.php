<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Добавить новую книгу';
$this->params['breadcrumbs'][] = ['label' => 'Список книг', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'year')->textInput() ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'cover_image')->fileInput() ?>

    <?= $form->field($model, 'authors')->checkboxList(
        \yii\helpers\ArrayHelper::map($authors, 'id', 'name')
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>