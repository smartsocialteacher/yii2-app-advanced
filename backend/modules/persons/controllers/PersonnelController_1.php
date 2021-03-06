<?php

namespace backend\modules\persons\controllers;

use Yii;
use backend\modules\persons\models\teach\TbPersonnel;
use backend\modules\persons\models\teacher\TbPersonnelSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\traits\AjaxValidationTrait;

/**
 * PersonnelController implements the CRUD actions for TbPersonnel model.
 */
class PersonnelController extends Controller {

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
     * Lists all TbPersonnel models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TbPersonnelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TbPersonnel model.
     * @param integer $person_id
     * @param integer $school_id
     * @param integer $position_id
     * @return mixed
     */
    public function actionView($person_id, $school_id, $position_id) {
        return $this->render('view', [
                    'model' => $this->findModel($person_id, $school_id, $position_id),
        ]);
    }

    /**
     * Creates a new TbPersonnel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TbPersonnel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'person_id' => $model->person_id, 'school_id' => $model->school_id, 'position_id' => $model->position_id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    public function actionCreateAjax($id) {
        $model = new TbPersonnel();
        $model->person_id = $id;
        $this->performAjaxValidation($model);
        
        if ($model->load(Yii::$app->request->post())) {
            
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
     * Updates an existing TbPersonnel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $person_id
     * @param integer $school_id
     * @param integer $position_id
     * @return mixed
     */
    public function actionUpdate($person_id, $school_id, $position_id) {
        $model = $this->findModel($person_id, $school_id, $position_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'person_id' => $model->person_id, 'school_id' => $model->school_id, 'position_id' => $model->position_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }
    public function actionUpdateAjax($person_id, $school_id, $position_id) {
        $model = $this->findModel($person_id, $school_id, $position_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'person_id' => $model->person_id, 'school_id' => $model->school_id, 'position_id' => $model->position_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TbPersonnel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $person_id
     * @param integer $school_id
     * @param integer $position_id
     * @return mixed
     */
    public function actionDelete($person_id, $school_id, $position_id) {
        $this->findModel($person_id, $school_id, $position_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TbPersonnel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $person_id
     * @param integer $school_id
     * @param integer $position_id
     * @return TbPersonnel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($person_id, $school_id, $position_id) {
        if (($model = TbPersonnel::findOne(['person_id' => $person_id, 'school_id' => $school_id, 'position_id' => $position_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
