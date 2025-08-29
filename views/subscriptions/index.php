<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Подписка на авторов';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="subscription-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'author_id')->dropDownList(
        \yii\helpers\ArrayHelper::map($authors, 'id', 'name'),
        ['prompt' => 'Выберите автора']
    ) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Подписаться', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>