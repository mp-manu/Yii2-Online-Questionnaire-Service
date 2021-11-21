<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnswersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Результаты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="answers-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'header' => 'Результаты',
                'attribute' => 'created_at',
                'format' => 'html',
                'value' => function($model){
                    return Html::a($model->created_at, \yii\helpers\Url::to('/answers/view/'.$model->uuid), ['target' => '_blank']);
                }

            ],
            [
                'class' => 'yii\grid\ActionColumn',
            ],
        ],
    ]); ?>


</div>
