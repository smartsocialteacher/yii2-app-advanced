<?php

namespace backend\modules\user\controllers;

use Yii;
use common\models\TbUser;
use backend\modules\user\models\TbUserProfile;
use backend\modules\user\models\TbUserProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProfileController implements the CRUD actions for TbUserProfile model.
 */
class ProfileController extends Controller
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
     * Lists all TbUserProfile models.
     * @return mixed
     */
//    public function actions($id=null){
//        //echo $id;
//        $model = $this->findModel($id);
//        print_r($model);
//        if(!$model){
//            $model=\common\models\TbUser::findOne($id);
//            if($model){
//                $model = new TbUserProfile();
//                $model->user_id = $id;
//                $model->save();
//            }
//        }
        
    //}
    public function actionIndex()
    {
        $searchModel = new TbUserProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TbUserProfile model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        
        if(!TbUserProfile::findOne($id)){            
            if(TbUser::findOne($id)){
                $model = new TbUserProfile();
                $model->user_id = $id;
                $model->save();
                $id = $model->user_id;
                return $this->redirect(['update', 'id' => $id]);
            }
        }      
        
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TbUserProfile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TbUserProfile();

        if ($model->load(Yii::$app->request->post())){
            if($model->save()) {
            Yii::$app->img->clearTempImg($model->user_img);
            return $this->redirect(['view', 'id' => $model->user_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TbUserProfile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->user_img_old = $model->user_img;
        if ($model->load(Yii::$app->request->post())){
            if($model->save()) {
                Yii::$app->img->clearTempImg($model->user_img,$model->user_img_old);
                return $this->redirect(['view', 'id' => $model->user_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TbUserProfile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TbUserProfile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TbUserProfile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TbUserProfile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
