<?php

namespace backend\modules\album\controllers;

use Yii;
use backend\modules\album\models\TbAlbum;
use backend\modules\album\models\TbAlbumCategory;
use backend\modules\album\models\TbAlbumCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\helpers\BaseFileHelper;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * CategoryController implements the CRUD actions for TbAlbumCategory model.
 */
class CategoryController extends Controller {

    public function behaviors() {
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
     * Lists all TbAlbumCategory models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TbAlbumCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TbAlbumCategory model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),          
        ]);
    }

    /**
     * Creates a new TbAlbumCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TbAlbumCategory();
        
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        
        if ($model->load(Yii::$app->request->post())) {
            
           // $this->CreateDir($model->album_cate_folder);
               
            if ($model->save()&&$this->CreateDir($model->album_cate_folder)) {
                return $this->redirect(['view', 'id' => $model->album_cate_id]);
            }
            //return $this->redirect(['view', 'id' => $model->album_cate_id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

   

    /**
     * Updates an existing TbAlbumCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }        
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->album_cate_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TbAlbumCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TbAlbumCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TbAlbumCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TbAlbumCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function CreateDir($folderName) {
        if ($folderName != NULL) {
            $basePath = TbAlbum::getUploadPath();
            if (BaseFileHelper::createDirectory($basePath . $folderName, 0777)) {
                BaseFileHelper::createDirectory($basePath . $folderName . '/thumbnail', 0777);
            }             
            return true;            
        }
       return false;
    }

}
