<?php


namespace app\controllers;


use app\models\Answers;
use app\models\Question;
use kartik\mpdf\Pdf;
use yii\web\Controller;

class ExportController extends Controller
{
    public function actionToPdf($uuid){
        ini_set('display_errors', 0);
        error_reporting(0);

        $answer = Answers::find()->where(['uuid' => $uuid])
            ->indexBy('question_id')
            ->asArray()
            ->all();

        if(!empty($answer)){
            $questions = Question::find()
                ->with('options')
                ->where(['question.status' => 1])
                ->asArray()->all();

            $html = $this->renderPartial('view', [
                'questions' => $questions,
                'answer' => $answer,
                'uuid' => $uuid
            ]);
        }

        $filename = 'result_'.$uuid.'.pdf';


        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $html,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
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
            // set mPDF properties on the fly
            'options' => ['title' => 'Результаты анкеты № '.$uuid],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader'=>['Enterprise Report'],
                'SetFooter'=>['{PAGENO}'],
            ],
            'filename' => $filename
        ]);

        return $pdf->render();
    }


}