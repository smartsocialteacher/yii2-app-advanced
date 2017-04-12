<?php

namespace app\modules\articles\controllers;

use Yii;
use backend\modules\articles\models\TbArticle;
use backend\modules\articles\models\TbArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for TbArticle model.
 */
class DefaultController extends Controller
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
     * Lists all TbArticle models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TbArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TbArticle model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TbArticle model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TbArticle();
        $redict="";
        if ($model->load(Yii::$app->request->post())){
            $current_time=date('Y-m-d H:s:i');
            $model->art_created=$current_time;
            $model->art_modified=$current_time;
            $model->user_id = Yii::$app->user->id;
            if($model->save()) {
                return $this->redirect([(Yii::$app->request->post('apply')?'update':'view'), 'id' => $model->art_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TbArticle model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post())){
            $current_time=date('Y-m-d H:s:i');
            $model->art_modified=$current_time;
            $model->user_id = Yii::$app->user->id;
            if($model->save()) {
            return $this->redirect([(Yii::$app->request->post('apply')?'update':'view'), 'id' => $model->art_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TbArticle model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

     public function actionDeleteAll(){
        if(Yii::$app->request->post('ids')!==null){
            $delete_ids = explode(',', Yii::$app->request->post('ids'));
            TbArticle::deleteAll(['in','art_id',$delete_ids]);
        }
        return $this->redirect(['index']);
    }
    
    /**
     * Finds the TbArticle model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TbArticle the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TbArticle::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
