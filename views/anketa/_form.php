<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Anketa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anketa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if (!empty($questions)): $i=0; ?>
        <?php foreach ($questions as $question): $i++; ?>
            <?= $form->field($model, 'question_id[]')->hiddenInput(['value' => $question['id']])->label($i.'. '.$question['lable']) ?>
            <?php
                switch ($question['type']){
                    case 1:
                        echo $form->field($model, 'option_id['.$question['id'].']')->radioList(['Да' => 'Да', 'Нет' => 'Нет'])->label(false);
                        break;
                    case 2:
                        if(!empty($question['options']) && count($question['options']) > 0)
                            echo $form->field($model, 'option_id['.$question['id'].']')->radioList(\yii\helpers\ArrayHelper::map($question['options'], 'id', 'value'))->label(false);
                        break;
                    case 3:
                        echo $form->field($model, 'option_id['.$question['id'].']')->textInput()->label(false);
                        break;
                    case 4:
                        echo $form->field($model, 'option_id['.$question['id'].']')->textarea(['rows' => 6])->label(false);
                        break;
                    case 5:
                        echo $form->field($model, 'option_id['.$question['id'].']')->checkboxList(\yii\helpers\ArrayHelper::map($question['options'], 'id', 'value'))->label(false);
                        break;
                    default:
                        break;
                }
            ?>
        <?php endforeach; ?>
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-warning']) ?>
        </div>
    <?php endif; ?>

    <?php ActiveForm::end(); ?>
</div>
