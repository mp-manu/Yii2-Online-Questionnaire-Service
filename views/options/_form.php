<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Options */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="options-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'question_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Question::find()->asArray()->all(), 'id', 'lable')) ?>
    <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-warning']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
