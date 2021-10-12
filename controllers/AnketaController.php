<?php

namespace app\controllers;

use app\models\Anketa;
use app\models\AnketaSearch;
use app\models\Answers;
use app\models\Options;
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
     * Lists all Anketa models.
     * @return mixed
     */
    public function actionIndex($password = 0)
    {
        if(\Yii::$app->user->isGuest) throw new HttpException(403/*or any code*/, 'Доступ запрешен!'/*or any message*/);
        $searchModel = new AnketaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Anketa model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
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

           foreach ($answersData as $question_id => $answer){
               if(empty($answer)) continue;
                $result = new Answers();
               $result->uuid = $uuid;
               $result->question_id = $question_id;
               if(is_numeric($answer)){
                   $result->option_id = $answer;
               }else{
                   $result->option_text = $answer;
               }
               $result->status = 1;
               $result->save();
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

    /**
     * Updates an existing Anketa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(\Yii::$app->user->isGuest) throw new HttpException(403/*or any code*/, 'Доступ запрешен!'/*or any message*/);
        $model = $this->findModel($id);
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Anketa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(\Yii::$app->user->isGuest) throw new HttpException(403/*or any code*/, 'Доступ запрешен!'/*or any message*/);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Anketa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Anketa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Anketa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
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
