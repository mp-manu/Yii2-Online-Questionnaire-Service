<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Anketa */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Anketas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="anketa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить результат опроса?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'age_and_education_id',
            'place_of_residence',
            'main_occupation_id',
            'knowledge_level_id',
            'cv_writing_skills',
            'computer_skills',
            'how_often_see_doctor',
            'play_sports',
            'improve_qualifications',
            'change_profession',
            'search_training_courses',
            'taken_edu_courses',
            'life_skills',
            'family_conditions',
            'famali_depends',
            'course_to_like_attend_id',
            'go_to_take_course_id',
            'most_important_for_checking_course_id',
            'attend_paid_courses',
            'time_attend_courses_id:datetime',
            'type_search_courses_id',
            'wishes_suggestions:ntext',
        ],
    ]) ?>

</div>
