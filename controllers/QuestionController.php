<?php

namespace app\controllers;

use app\models\Question;
use app\models\QuestionSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QuestionController implements the CRUD actions for Question model.
 */
class QuestionController extends Controller
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
     * Lists all Question models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(\Yii::$app->user->isGuest) throw new HttpException(403/*or any code*/, 'Доступ запрешен!'/*or any message*/);
        $searchModel = new QuestionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Question model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(\Yii::$app->user->isGuest) throw new HttpException(403/*or any code*/, 'Доступ запрешен!'/*or any message*/);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Question model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(\Yii::$app->user->isGuest) throw new HttpException(403/*or any code*/, 'Доступ запрешен!'/*or any message*/);
        $model = new Question();

        if ($this->request->isPost && $model->load($this->request->post())) {
            if (empty($model->sort)) $model->sort = 999999999;

            if ($model->save()) {
                \Yii::$app->session->setFlash('success', 'Вопрос успешно добавлен!');
            } else {
                \Yii::$app->session->setFlash('error', 'Не удалось сохранить вопрос!');
            }
            return $this->redirect(['index']);
        }else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Question model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(\Yii::$app->user->isGuest) throw new HttpException(403/*or any code*/, 'Доступ запрешен!'/*or any message*/);
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            if (empty($model->sort)) $model->sort = 999999999;

            if ($model->save()) {
                \Yii::$app->session->setFlash('success', 'Вопрос успешно добавлен!');
            } else {
                \Yii::$app->session->setFlash('error', 'Не удалось сохранить вопрос!');
            }
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Question model.
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
     * Finds the Question model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Question the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Question::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
