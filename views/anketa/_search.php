<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AnketaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anketa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'age_and_education_id') ?>

    <?= $form->field($model, 'place_of_residence') ?>

    <?= $form->field($model, 'main_occupation_id') ?>

    <?= $form->field($model, 'knowledge_level_id') ?>

    <?php // echo $form->field($model, 'cv_writing_skills') ?>

    <?php // echo $form->field($model, 'computer_skills') ?>

    <?php // echo $form->field($model, 'how_often_see_doctor') ?>

    <?php // echo $form->field($model, 'play_sports') ?>

    <?php // echo $form->field($model, 'improve_qualifications') ?>

    <?php // echo $form->field($model, 'change_profession') ?>

    <?php // echo $form->field($model, 'search_training_courses') ?>

    <?php // echo $form->field($model, 'taken_edu_courses') ?>

    <?php // echo $form->field($model, 'life_skills') ?>

    <?php // echo $form->field($model, 'family_conditions') ?>

    <?php // echo $form->field($model, 'famali_depends') ?>

    <?php // echo $form->field($model, 'course_to_like_attend_id') ?>

    <?php // echo $form->field($model, 'go_to_take_course_id') ?>

    <?php // echo $form->field($model, 'most_important_for_checking_course_id') ?>

    <?php // echo $form->field($model, 'attend_paid_courses') ?>

    <?php // echo $form->field($model, 'time_attend_courses_id') ?>

    <?php // echo $form->field($model, 'type_search_courses_id') ?>

    <?php // echo $form->field($model, 'wishes_suggestions') ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Сброс', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
