<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Anketa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anketa-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--    --><? //= $form->field($model, 'age_and_education_id')->textInput() ?>
    <!---->
    <!--    --><? //= $form->field($model, 'place_of_residence')->textInput(['maxlength' => true]) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'main_occupation_id')->textInput() ?>
    <!---->
    <!--    --><? //= $form->field($model, 'knowledge_level_id')->textInput() ?>
    <!---->
    <!--    --><? //= $form->field($model, 'cv_writing_skills')->dropDownList([ 'yes' => 'Yes', 'no' => 'No', 'do_not_know' => 'Do not know', ], ['prompt' => '']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'computer_skills')->dropDownList([ 'yes' => 'Yes', 'no' => 'No', ], ['prompt' => '']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'how_often_see_doctor')->textInput(['maxlength' => true]) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'play_sports')->dropDownList([ 'yes' => 'Yes', 'no' => 'No', ], ['prompt' => '']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'improve_qualifications')->dropDownList([ 'yes' => 'Yes', 'no' => 'No', ], ['prompt' => '']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'change_profession')->dropDownList([ 'yes' => 'Yes', 'no' => 'No', ], ['prompt' => '']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'search_training_courses')->dropDownList([ 'yes' => 'Yes', 'no' => 'No', ], ['prompt' => '']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'taken_edu_courses')->dropDownList([ 'yes' => 'Yes', 'no' => 'No', ], ['prompt' => '']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'life_skills')->dropDownList([ 'leadership' => 'Leadership', 'making_decisions' => 'Making decisions', 'communication' => 'Communication', ], ['prompt' => '']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'family_conditions')->dropDownList([ 'yes' => 'Yes', 'no' => 'No', ], ['prompt' => '']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'famali_depends')->textInput(['maxlength' => true]) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'course_to_like_attend_id')->textInput() ?>
    <!---->
    <!--    --><? //= $form->field($model, 'go_to_take_course_id')->textInput() ?>
    <!---->
    <!--    --><? //= $form->field($model, 'most_important_for_checking_course_id')->textInput() ?>
    <!---->
    <!--    --><? //= $form->field($model, 'attend_paid_courses')->dropDownList([ 'yes' => 'Yes', 'no' => 'No', ], ['prompt' => '']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'time_attend_courses_id')->textInput() ?>
    <!---->
    <!--    --><? //= $form->field($model, 'type_search_courses_id')->textInput() ?>
    <!---->
    <!--    --><? //= $form->field($model, 'wishes_suggestions')->textarea(['rows' => 6]) ?>

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
