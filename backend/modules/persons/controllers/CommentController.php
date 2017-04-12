<?php

namespace backend\modules\persons\controllers;

use Yii;
use backend\modules\persons\models\TbPersonComment;
use backend\modules\persons\models\TbPersonCommentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CommentController implements the CRUD actions for TbPersonComment model.
 */
class CommentController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all TbPersonComment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TbPersonCommentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TbPersonComment model.
     * @param integer $person_id
     * @param string $person_comment_datetime
     * @return mixed
     */
    public function actionView($person_id, $person_comment_datetime)
    {
        return $this->render('view', [
            'model' => $this->findModel($person_id, $person_comment_datetime),
        ]);
    }

    /**
     * Creates a new TbPersonComment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TbPersonComment();

        if ($model->load(Yii::$app->request->post())){
            $model->person_comment_datetime = date('Y-m-d H:i:s');
            
            if($model->save()) {        
            return $this->redirect(['view', 'person_id' => $model->person_id, 'person_comment_datetime' => $model->person_comment_datetime]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TbPersonComment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $person_id
     * @param string $person_comment_datetime
     * @return mixed
     */
    public function actionUpdate($person_id, $person_comment_datetime)
    {
        $model = $this->findModel($person_id, $person_comment_datetime);

        if ($model->load(Yii::$app->request->post())){
            $model->person_comment_datetime = date('Y-m-d H:i:s');
            
            if($model->save()) {        
            return $this->redirect(['view', 'person_id' => $model->person_id, 'person_comment_datetime' => $model->person_comment_datetime]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TbPersonComment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $person_id
     * @param string $person_comment_datetime
     * @return mixed
     */
    public function actionDelete($person_id, $person_comment_datetime)
    {
        $this->findModel($person_id, $person_comment_datetime)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TbPersonComment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $person_id
     * @param string $person_comment_datetime
     * @return TbPersonComment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($person_id, $person_comment_datetime)
    {
        if (($model = TbPersonComment::findOne(['person_id' => $person_id, 'person_comment_datetime' => $person_comment_datetime])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
