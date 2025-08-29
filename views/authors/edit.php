<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Редактировать автора: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Список авторов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="author-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>