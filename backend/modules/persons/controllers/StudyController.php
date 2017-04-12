<?php

namespace backend\modules\persons\controllers;

use Yii;
use backend\modules\persons\models\education\TbStudy;
use backend\modules\persons\models\education\TbStudySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\persons\models\Model;
//use yii\base\Model;
use backend\modules\persons\models\TbPerson;
use yii\data\ActiveDataProvider;
use common\traits\AjaxValidationTrait;

/**
 * StudyController implements the CRUD actions for TbStudy model.
 */
class StudyController extends Controller {

        use AjaxValidationTrait;
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
     * Lists all TbStudy models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TbStudySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TbStudy model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TbStudy model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TbStudy();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->study_id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    public function actionViewAjax($id) {
        $modelStudy = TbStudy::find()
                ->where(['person_id' => $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $modelStudy,
            'pagination' => [
            //'pageSize' => 20,
            ],
        ]);

        return $this->renderAjax('viewAjax', [
                    //'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreateAjax($id) {
        $model = new TbStudy();
        $this->performAjaxValidation($model);
        if ($model->load(Yii::$app->request->post())) {
            $model->person_id = $id;
            //$model->study_year_finish=$model->study_year_finish-543;
            if ($model->save()) {
                return $this->redirect(['/persons/default/profile/', 'id' => $id]);
            }            
        } else {
            return $this->renderAjax('_form', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TbStudy model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->study_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    public function actionUpdateAjax($id, $person = "") {
        $model = $this->findModel($id);
        $this->performAjaxValidation($model);        
        if ($model->load(Yii::$app->request->post())){           
            if($model->save()) {
            }
            return $this->redirect(['/persons/default/profile/', 'id' => $person]);
        } else {

            return $this->renderAjax('_form', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TbStudy model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();        
        return $this->redirect(['index']);
    }

    public function actionDeleteAjax($id, $person = "") {
        $this->findModel($id)->delete();
        return $this->redirect(['/persons/default/profile/', 'id' => $person]);
    }

    /**
     * Finds the TbStudy model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TbStudy the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TbStudy::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
