<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Answers */

$this->title = $uuid;
$this->params['breadcrumbs'][] = ['label' => 'Результаты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$cyr = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У',
    'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я');
?>
<style>
    body {
        background: rgb(204, 204, 204);
    }
    .choosed{
        font-weight: bold;
        text-decoration: underline;
    }
</style>
<center>
    <a href="/export/to-pdf/<?= $uuid ?>" class="btn btn-warning">Экпорт в PDF</a>
    <a href="/export/to-excel/<?= $uuid ?>" class="btn btn-success">Экпорт в Excel</a>
</center><br>
<page size="A4">
    <b>
        <div class="page_title_head">Уважаемый участник опроса!</div>
    </b>
    <p class="page_title">
        <span class="text">Просим Вас не оставаться равнодушными и принять активное участие в различных форматах определения нужд взрослого
        населения в рамках реализуемого проекта. Этот опрос поможет определить образовательные нужды населения
        г.Гулистона для создания ЦОМСа. Анкета анонимная, поэтому свою фамилию указывать не надо. Все Ваши ответы будут
        использованы только в данном исследовании.</span>
    </p>
    <b>
        <div class="page_title_head">Анкета</div>
    </b>
    <?php
    $i = 0;
    foreach ($questions as $question_key => $question): $i++; ?>
        <p><b><?= $i . '. ' . $question['lable'] ?></b></p>
        <?php

        if (!empty($question['options']) && count($question['options']) > 0):
            $k = 0;
            foreach($question['options'] as $option):
                $choosed = (!empty($answer[$question['id']]) &&  $answer[$question['id']]['option_id'] == $option['id']) ? 'choosed' : '';
                if($question['type'] == 5 && $multipleAnswers = explode(',', $answer[$question['id']]['multipleAnswers'])){
                    $choosed = (count($multipleAnswers) >= 1 && in_array($option['id'], $multipleAnswers)) ? 'choosed' : '';
                }
            ?>
                <p class="<?= $choosed ?>"><?= $cyr[$k] . ') ' . $option['value'] ?></p>
                <?php $k++; endforeach; ?>
        <?php endif; ?>
        <?php
                if(!empty($answer[$question['id']]) && !empty($answer[$question['id']]['option_text']))
                echo "<p>". $answer[$question['id']]['option_text'] ."</p>";
                endforeach;
        ?>
    <h6 class="font-weight-bold text-center">БЛАГОДАРИМ ВАС ЗА УЧАСТИЕ В ОПРОСЕ!</h6>
</page>



