<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Question */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'lable')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList(['1' => 'Да/Нет', '2' => 'Варианты', '3' => 'Короткий текст', '4' => 'Длинный текст', '5' => 'Различные варианты']) ?>

    <?= $form->field($model, 'status')->dropDownList(['1' => 'Активный', '0' => 'Отключен']) ?>

    <?= $form->field($model, 'sort')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
