<?php

namespace backend\modules\persons\controllers;

use Yii;
use backend\modules\persons\models\teacher\TbClassTeacher;
use backend\modules\persons\models\teacher\TbClassTeacherSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\traits\AjaxValidationTrait;

/**
 * TeacherController implements the CRUD actions for TbClassTeacher model.
 */
class TeacherController extends Controller
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
     * Lists all TbClassTeacher models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TbClassTeacherSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TbClassTeacher model.
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
     * Creates a new TbClassTeacher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TbClassTeacher();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->class_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    use AjaxValidationTrait;
 public function actionCreateAjax($id)
    {
        $model = new TbClassTeacher();
        
        $this->performAjaxValidation($model);
       if ($model->load(Yii::$app->request->post())) {
            $model->person_id = $id;
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
     * Updates an existing TbClassTeacher model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->class_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    public function actionUpdateAjax($id,$person)
    {
        $model = $this->findModel($id);

        $this->performAjaxValidation($model);
       if ($model->load(Yii::$app->request->post())) {           
            if ($model->save()) {
                return $this->redirect(['/persons/default/profile/', 'id' => $person]);
            }
        } else {
            return $this->renderAjax('_form', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TbClassTeacher model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionDeleteAjax($id,$person)
    {
        $this->findModel($id)->delete();

       return $this->redirect(['/persons/default/profile/', 'id' => $person]);
    }

    /**
     * Finds the TbClassTeacher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TbClassTeacher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TbClassTeacher::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
