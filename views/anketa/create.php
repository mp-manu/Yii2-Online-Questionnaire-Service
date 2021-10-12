<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Anketa */

$this->title = 'Опрос';
//$this->params['breadcrumbs'][] = ['label' => 'Анкеты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anketa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'options' => $options,
        'questions' => $questions
    ]) ?>

</div>
