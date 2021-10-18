<?php


namespace app\controllers;


use app\models\Answers;
use yii\web\Controller;

class StatController extends Controller
{
    public function actionIndex(){

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

//        echo '<pre>';
//        print_r($data);
//        die();

        return $this->render('index', [
            'data' => $data,
            'maxAnswerCount' => $maxAnswerCount
        ]);
    }

}