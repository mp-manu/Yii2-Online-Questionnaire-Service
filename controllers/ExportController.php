<?php


namespace app\controllers;


use app\models\Answers;
use app\models\Question;
use kartik\mpdf\Pdf;
use yii\web\Controller;

class ExportController extends Controller
{
    public function actionToPdf($uuid){


        $answer = Answers::find()->where(['uuid' => $uuid])
            ->indexBy('question_id')
            ->asArray()
            ->all();

        if(!empty($answer)){
            $questions = Question::find()
                ->with('options')
                ->where(['question.status' => 1])
                ->asArray()->all();

            $html = $this->renderPartial('pdf', [
                'questions' => $questions,
                'answer' => $answer,
                'uuid' => $uuid
            ]);
        }

        $filename = 'result_'.$uuid.'.pdf';


        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,

            'format' => Pdf::FORMAT_A4,

            'orientation' => Pdf::ORIENT_PORTRAIT,

            'destination' => Pdf::DEST_BROWSER,

            'content' => $html,

            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px} 
            body {
                font-family: "Times New Roman";
            }
            .choosed{
                font-weight: bold;
                text-decoration: underline;
            }
            .page_title_head{
                text-align: center!important;
            }
            .page_title{
                font-style: italic;
                font-weight: bold;
                text-align: justify;
                text-indent: 1.5cm;
            }',

            'options' => ['title' => 'Результаты анкеты № '.$uuid],

            'methods' => [
                'SetHeader'=>['title' => 'Результаты анкеты № '.$uuid],
                'SetFooter'=>['{PAGENO}'],
            ],
            'filename' => $filename
        ]);
        return $pdf->render();
    }


    public function actionToExcel($uuid)
    {
        $this->layout = '@app/views/layouts/export';
        $answer = Answers::find()->where(['uuid' => $uuid])
            ->indexBy('question_id')
            ->asArray()
            ->all();

        if(!empty($answer)){
            $questions = Question::find()
                ->with('options')
                ->where(['question.status' => 1])
                ->asArray()->all();

            $file = $this->render('excel', [
                'questions' => $questions,
                'answer' => $answer,
                'uuid' => $uuid
            ]);
        }

        $fileName = 'result_'.$uuid.'.xls';

        $options = ['mimeType' => 'application/vnd.ms-excel'];
        return \Yii::$app->excel->exportExcel($file, $fileName, $options);
    }

    public function actionToExcelStatistics()
    {
        $this->layout = '@app/views/layouts/export';

        $statData = Answers::find()
            ->select('q.lable, o.value, count(a.id) as answer_count, a.question_id, a.option_id, SUM(1) as sum')
            ->from('answers a')
            ->innerJoin('question q', 'a.question_id = q.id')
            ->innerJoin('options o', 'a.option_id = o.id')
            ->where('!ISNULL(a.option_id)')
            ->andWhere(['q.status' => 1])
            ->groupBy('a.question_id, a.option_id')->asArray()->all();

        $data = array();

        $maxAnswerCount = Answers::find()->select('count(id) as maxAmount')->groupBy('question_id')->orderBy('count(id) desc')->asArray()->one();

        foreach ($statData as $item){
            $data[$item['question_id']]['question_id'][] = $item['question_id'];
            $data[$item['question_id']]['option_id'][] = $item['option_id'];
            $data[$item['question_id']]['answer_count'][] = $item['answer_count'];
            $data[$item['question_id']]['value'][] = $item['value'];
            $data[$item['question_id']]['lable'][] = $item['lable'];
            @$data[$item['question_id']]['sum'] += $item['answer_count'];
        }

        $file = $this->render('stat', [
            'data' => $data,
            'maxAnswerCount' => $maxAnswerCount
        ]);

        $fileName = 'stat_'.date('Y-m-d H:i:s').'.xls';

        $options = ['mimeType' => 'application/vnd.ms-excel'];

        return \Yii::$app->excel->exportExcel($file, $fileName, $options);
    }
}