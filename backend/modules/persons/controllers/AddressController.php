<?php

namespace backend\modules\persons\controllers;

use Yii;
use backend\modules\persons\models\TbAddress;
use backend\modules\persons\models\TbAddressSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use backend\modules\persons\models\address\TbProvince;
use backend\modules\persons\models\address\TbAmphur;
use backend\modules\persons\models\address\TbTambol;
use yii\helpers\ArrayHelper;

/**
 * AddressController implements the CRUD actions for TbAddress model.
 */
class AddressController extends Controller {

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
     * Lists all TbAddress models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TbAddressSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TbAddress model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TbAddress model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TbAddress();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->address_id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TbAddress model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $person) {
        $model = $this->findModel($id);
        $amphur = ArrayHelper::map($this->getAmphur($model->province_id), 'amphur_id', 'amphur_name');
        $tambol = ArrayHelper::map($this->getTambol($model->amphur_id), 'tambol_id', 'tambol_name');
        //print_r($amphur);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          
                return $this->redirect(['view', 'id' => $model->address_id]);
            
        } else {
           
                return $this->render('update', [
                            'model' => $model,
                            'amphur' => $amphur,
                            'tambol' => $tambol
                ]);
           
        }
    }
    public function actionUpdateAjax($id, $person) {
        $model = $this->findModel($id);
        $amphur = ArrayHelper::map($this->getAmphur($model->province_id),'id', 'name');
        $tambol = ArrayHelper::map($this->getTambol($model->amphur_id), 'id', 'name');
        //print_r($amphur);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           
                return $this->redirect(['/persons/default/profile/', 'id' => $person]);
           
        } else {
           
                return $this->renderAjax('_form', [
                            'model' => $model,
                            'amphur' => $amphur,
                            'tambol' => $tambol
                ]);
            
        }
    }

    /**
     * Deletes an existing TbAddress model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id, $person_id) {
        $this->findModel($id)->delete();

        return $this->redirect(['/persons/default/profile', 'id' => $person_id]);
    }

    /**
     * Finds the TbAddress model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TbAddress the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TbAddress::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    #####################################################################
    #####################################################################
    #####################################################################

    public function actionGetAmphur() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $province_id = $parents[0];
                $out = $this->getAmphur($province_id);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionGetTambol() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $province_id = empty($ids[0]) ? null : $ids[0];
            $amphur_id = empty($ids[1]) ? null : $ids[1];
            if ($province_id != null) {
                $data = $this->getTambol($amphur_id);
                echo Json::encode(['output' => $data, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    protected function getAmphur($id) {
        $datas = TbAmphur::find()->where(['province_id' => $id])->all();
        return $this->MapData($datas, 'amphur_id', 'amphur_name');
    }

    protected function getTambol($id) {
        $datas = TbTambol::find()->where(['amphur_id' => $id])->all();
        return $this->MapData($datas, 'tambol_id', 'tambol_name');
    }

    protected function MapData($datas, $fieldId, $fieldName) {
        $obj = [];
        foreach ($datas as $key => $value) {
            array_push($obj, ['id' => $value->{$fieldId}, 'name' => $value->{$fieldName}]);
        }
        return $obj;
    }

}
