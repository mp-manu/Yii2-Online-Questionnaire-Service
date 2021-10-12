<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnketaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Анкеты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anketa-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать анкету', ['create'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'age_and_education_id',
            'place_of_residence',
            'main_occupation_id',
            'knowledge_level_id',
            //'cv_writing_skills',
            //'computer_skills',
            //'how_often_see_doctor',
            //'play_sports',
            //'improve_qualifications',
            //'change_profession',
            //'search_training_courses',
            //'taken_edu_courses',
            //'life_skills',
            //'family_conditions',
            //'famali_depends',
            //'course_to_like_attend_id',
            //'go_to_take_course_id',
            //'most_important_for_checking_course_id',
            //'attend_paid_courses',
            //'time_attend_courses_id:datetime',
            //'type_search_courses_id',
            //'wishes_suggestions:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
