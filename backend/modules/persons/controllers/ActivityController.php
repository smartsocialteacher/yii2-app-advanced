<?php

namespace backend\modules\persons\controllers;

use Yii;
use backend\modules\persons\models\activity\TbActivity;
use backend\modules\persons\models\activity\TbActivitySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\persons\models\activity\TbLocation;
use backend\modules\persons\models\activity\TbActivityJoin;
use backend\modules\persons\models\TbPerson;
use backend\modules\persons\models\TbPersonSearch;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\Response;
use yii\widgets\ActiveForm;
use common\traits\AjaxValidationTrait;

/**
 * ActivityController implements the CRUD actions for TbActivity model.
 */
class ActivityController extends Controller {
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
     * Lists all TbActivity models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TbActivitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TbActivity model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {

        $searchModel = new TbPersonSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $param = Yii::$app->request->queryParams;

        $modelPerson = TbPerson::find()
                ->innerJoinWith('tbActivityJoins')
                ->where(['tb_activity_join.activity_id' => $id]);
        if (isset($param['TbPersonSearch'])) {
            $modelPerson->andWhere('person_name LIKE "%' . $param['TbPersonSearch']['fullName'] . '%" ' .
                    'OR person_surname LIKE "%' . $param['TbPersonSearch']['fullName'] . '%"');
            $modelPerson->andWhere('person_email LIKE "%' . $param['TbPersonSearch']['person_email'] . '%" ');
            // $modelPerson->andFilterWhere(['like', 'tb_activity_join.person_mode', $param['tb_activity_join']['person_mode']])   ;
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $modelPerson,
            'pagination' => [
            //'pageSize' => 20,
            ],
        ]);

        //$dataProvider->pagination->pageSize = 6;
        //$dataProvider->sort->defaultOrder = ['art_id'=>'DESC'];
        //print_r($modelPerson);

        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'modelPerson' => $dataProvider,
                    'searchModel' => $searchModel
        ]);
    }

    /**
     * Creates a new TbActivity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TbActivity();

        if ($model->load(Yii::$app->request->post())) {

            $post = Yii::$app->request->post();
           $model->location_id = $this->chkTb(TbLocation::className(), $post['TbActivity'], 'location_id', 'location_title');
            //print_r($location_id);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->activity_id]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    public function actionActivityList($q = null, $id = null) {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
//            $data = TbActivity::find()
//                    ->select('activity_id as id, activity_title as text')
//                    ->where(['LIKE', 'activity_title', $q])
//                    ->all();
//            print_r($data);
            $query = new Query;
            $query->select('activity_id as id, activity_title as text')
                    ->from('tb_activity')
                    ->where(['like', 'activity_title', $q])
                    ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();

            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => TbActivity::find($id)->activity_title];
        }
        return $out;
    }

    public function actionCreateAjax($id, $activity_id = "") {
        $model = new TbActivity();
        //print_r(Yii::$app->request->post());

        if ($model->load(Yii::$app->request->post())) {
            $model->person_id = $id;
            $post = Yii::$app->request->post();
            $model->location_id = $this->chkTb(TbLocation::className(), $post['TbActivity'], 'location_id', 'location_title');
            if ($model->save()) {
                return $this->redirect(['/persons/default/profile/', 'id' => $id]);
            }
        } elseif (isset($activity_id) && !empty($activity_id)) {
            $model = new TbActivityJoin();
            $model->person_id = $id;
            $model->activity_id = $activity_id;
            $model->person_mode = '2';
            if ($model->validate() && $model->save()) {
                $model->save();
            } else {
                //print_r($model->getErrors()) ;
                //$string = implode(',',$model->getErrors());
                Yii::$app->session->setFlash('error', 'ข้อมูลมีอยู่แล้ว');
            }
            return $this->redirect(['/persons/default/profile/', 'id' => $id]);
        } else {
            $searchModel = new TbActivitySearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->renderAjax('_tab', [
                        'model' => $model,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        }
    }

    public function actionCreateAjaxTab() {
        $model = new TbActivity();
        
        $this->performAjaxValidation($model);
         
        if ($model->load(Yii::$app->request->post())) {          
            $post = Yii::$app->request->post();
            $model->location_id = $this->chkTb(TbLocation::className(), $post['TbActivity'], 'location_id', 'location_title');
            //print_r($location_id);
            if ($model->save()) {
                //return $this->redirect(['view', 'id' => $model->activity_id]);
                echo json_encode(['success' => 'true']);
            }else{
                print_r($model->getErrors());
            }         
        } else {
            return $this->renderAjax('_form', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TbActivity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        //print_r(Yii::$app->request->post());

        if ($model->load(Yii::$app->request->post())) {

            //print_r($location_id);
            $post = Yii::$app->request->post();
            $model->location_id = $this->chkTb(TbLocation::className(), $post['TbActivity'], 'location_id', 'location_title');
            if ($model->save()) {
                return $this->redirect(['register', 'id' => $model->activity_id]);
            }
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    public function chkTb($modelName, $val, $id, $title) {
        //$modelName = 'backend\\modules\\persons\\models\\activity\\' . $tb;
        // $this->pr($val);        
        //$formName = $modelPost->formName();
        //$val;
        if ($val[$id]) {
            $modelPost = new $modelName();
            $model = $modelName::find()->where([$id => $val[$id]])->one();
            //$this->pr($model);
            if (!$model) {
                //$this->pr($model);
                $model = new $modelName();
                $model->$title = $val[$id];
                //$val[$title]=$val[$id];
                if (!$model->save()) {
                    $this->pr($model->getErrors());
                }
                return $model->$id;
            } else {
                return $model->$id;
            }
        }
        //echo $model->$id;
    }

    /**
     * Deletes an existing TbActivity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteAjax($id, $person = "") {
        // $this->findModel($id)->delete();
        $model = TbActivityJoin::findOne(['activity_id' => $id, 'person_id' => $person]);
        if ($model->delete()) {
            return $this->redirect(['/persons/default/profile/', 'id' => $person]);
        }
    }

    public function actionPersonDelete($id, $person) {
        //$this->findModel($id)->delete();
        //echo $id;
        TbActivityJoin::find()->where(['activity_id' => $id, 'person_id' => $person])->one()->delete();
        //echo $person;

        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionRegister($id) {
        return $this->render('register', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the TbActivity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TbActivity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TbActivity::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
