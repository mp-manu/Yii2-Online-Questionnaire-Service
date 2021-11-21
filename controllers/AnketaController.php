<?php

namespace app\controllers;

use app\models\Anketa;
use app\models\AnketaSearch;
use app\models\Answers;
use app\models\Options;
use app\models\OptionsSearch;
use app\models\Question;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AnketaController implements the CRUD actions for Anketa model.
 */
class AnketaController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Creates a new Anketa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Answers();
        $options = Options::find()->where(['status' => 1])->indexBy('id')->asArray()->all();
        $questions = Question::find()
            ->with('options')
            ->where(['question.status' => 1])
            ->asArray()->all();


        if ($this->request->isPost) {
           $answersData = $this->request->post('Answers')['option_id'];
           $uuid = $this->getGuid();

//           echo '<pre>';
//           print_r($answersData);
//           die();
           $created_at = date('Y-m-d H:i:s');
           foreach ($answersData as $question_id => $answer){
               if(empty($answer)) continue;
               if(is_array($answer) && count($answer) > 0){
                   foreach ($answer as $item){
                       $result = new Answers();
                       $result->uuid = $uuid;
                       $result->question_id = $question_id;
                       if(is_numeric($item)){
                           $result->option_id = $item;
                       }else{
                           $result->option_text = $item;
                       }
                       $result->status = 1;
                       $result->created_at = $created_at;
                       $result->save();
                   }
               }else{
                   $result = new Answers();
                   $result->uuid = $uuid;
                   $result->question_id = $question_id;
                   if(is_numeric($answer)){
                       $result->option_id = $answer;
                   }else{
                       $result->option_text = $answer;
                   }
                   $result->status = 1;
                   $result->created_at = $created_at;
                   $result->save();
               }
           }
           return $this->redirect(['/site/thank-you']);
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'options' => $options,
            'questions' => $questions
        ]);
    }


    protected function getGuid()
    {
        if (function_exists("com_create_guid")){
            return com_create_guid();
        }else{
            mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
            $charId = md5(uniqid(rand(), true));
            $hyphen = chr(45);// "-"
            $uuid =substr($charId, 0, 8).$hyphen
                .substr($charId, 8, 4).$hyphen
                .substr($charId,12, 4).$hyphen
                .substr($charId,16, 4).$hyphen
                .substr($charId,20,12);
            return $uuid;
        }
    }
}
