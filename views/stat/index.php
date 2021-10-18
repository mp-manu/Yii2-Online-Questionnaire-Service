<?php

use yii\bootstrap4\Html;

$this->title = 'Статистика';
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
if (!empty($data)) {
?>

    <table class="table table-bordered table-responsive table-hover">
        <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col" rowspan="2">Вопрос</th>
            <th scope="col" colspan="<?= $maxAnswerCount['maxAmount'] ?>">Ответ / Количество</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0;
        foreach ($data as $key => $item): $i++; ?>
            <tr>
                <td rowspan="3"><?= $i ?></td>
                <td rowspan="3"><?= $item['lable'][0] ?></td>
                <?php $td = 0;
                foreach ($item['value'] as $options): $td++; ?>
                    <td><?= $options ?></td>
                <?php endforeach; ?>
                <?php for ($a = 1; $a <= $maxAnswerCount['maxAmount'] - count($item['value']); $a++) {
                    echo '<td></td>';
                } ?>
            </tr>
            <tr>
                <?php $td2 = 0;
                foreach ($item['answer_count'] as $kol): $td2++; ?>
                    <td><?= $kol ?></td>
                <?php endforeach; ?>
                <?php for ($a = 1; $a <= ($maxAnswerCount['maxAmount'] - count($item['answer_count'])); $a++) {
                    echo '<td></td>';
                } ?>
            </tr>
            <tr>
                <?php $td3 = 0;
                foreach ($item['answer_count'] as $kol): $td3++; ?>
                    <td><?= ($kol / $item['sum']) * 100 .'%' ?></td>
                <?php endforeach; ?>
                <?php for ($a = 1; $a <= ($maxAnswerCount['maxAmount'] - count($item['answer_count'])); $a++) {
                    echo '<td></td>';
                } ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php }else{
    echo '<h2 class="text-success text-center">Информация не существует!</h2>';
} ?>