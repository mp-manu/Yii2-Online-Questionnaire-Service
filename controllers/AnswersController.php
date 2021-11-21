<?php

namespace app\controllers;

use app\models\Answers;
use app\models\AnswersSearch;
use app\models\Question;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AnswersController implements the CRUD actions for Answers model.
 */
class AnswersController extends Controller
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
     * Lists all Answers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnswersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Answers model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($uuid)
    {
        $answer = Answers::find()->select('*, group_concat(option_id) as multipleAnswers')->where(['uuid' => $uuid])
            ->indexBy('question_id')
            ->asArray()
            ->groupBy('question_id')
            ->all();
        if(!empty($answer)){
            $questions = Question::find()
                ->with('options')
                ->where(['question.status' => 1])
                ->asArray()->all();

            return $this->render('view', [
                'questions' => $questions,
                'answer' => $answer,
                'uuid' => $uuid
            ]);
        }
        throw new HttpException('403', 'Страница не существует!');
    }

    /**
     * Creates a new Answers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Answers();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Answers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Answers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionPdf($uuid){

        \Yii::$app->response->format = 'pdf';
        \Yii::$container->set(\Yii::$app->response->formatters['pdf']['class'], [
            'format' => [216, 356],
            'orientation' => 'Landscape',
            'beforeRender' => function($mpdf, $data) {},
        ]);

        $answer = Answers::find()->where(['uuid' => $uuid])
            ->indexBy('question_id')
            ->asArray()
            ->all();

        if(!empty($answer)){
            $questions = Question::find()
                ->with('options')
                ->where(['question.status' => 1])
                ->asArray()->all();

            return $this->render('pdf', [
                'questions' => $questions,
                'answer' => $answer,
                'uuid' => $uuid
            ]);
        }else{
            throw new HttpException('403', 'Страница не существует!');
        }
    }

    /**
     * Finds the Answers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Answers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Answers::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
