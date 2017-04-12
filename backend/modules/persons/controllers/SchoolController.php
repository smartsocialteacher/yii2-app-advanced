<?php

namespace backend\modules\persons\controllers;

use Yii;
use backend\modules\persons\models\teach\TbSchool;
use backend\modules\persons\models\teach\TbSchoolSearch;
use backend\modules\persons\models\teach\TbSchoolLevelJion;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\persons\models\Model;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\slide\models\TbImages;
use common\traits\AjaxValidationTrait;
use yii\web\UploadedFile;
use backend\modules\persons\models\teach\TbPersonnel;

/**
 * SchoolController implements the CRUD actions for TbSchool model.
 */
class SchoolController extends Controller
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
     * Lists all TbSchool models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TbSchoolSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$searchModel,
        ]);
    }

    /**
     * Displays a single TbSchool model.
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
     * Creates a new TbSchool model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TbSchool();
        $modelSchoolLevelJion =  new TbSchoolLevelJion();

       
        
        if ($model->load(Yii::$app->request->post())) {
            $post=Yii::$app->request->post();
            $modelSchoolLevelJion->load(Yii::$app->request->post());
            //$modelSchoolLevelJion = Model::createMultiple(TbSchoolLevelJion::classname());
            //Model::loadMultiple($modelSchoolLevelJion, Yii::$app->request->post());
           
            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    //ActiveForm::validateMultiple($modelSchoolLevelJion),
                   ActiveForm::validate($modelSchoolLevelJion),
                   ActiveForm::validate($model)
                );
            }
           //print_r($post);
            //exit();
            // validate all models
            $valid = $model->validate();  
            //$valid = $modelSchoolLevelJion->validate() && $valid;
            //echo $valid;
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
               
                try { 
                    
                    $model->school_title = str_replace($model->getAttributeLabel('school'), '', $model->school_title);
                    if ($flag = $model->save(false)) {
                        
                        if(isset($post['TbSchoolLevelJion'])){
                        foreach ($post['TbSchoolLevelJion']['school_level_id'] as $school_level_id) {
                            $modeJion=new TbSchoolLevelJion();
                            $modeJion->school_id = $model->school_id;
                            $modeJion->school_level_id= $school_level_id;
                            if (! ($flag = $modeJion->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->school_id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        } 
            return $this->render('create', [
                'model' => $model,
                'modelSchoolLevelJion' => $modelSchoolLevelJion
            ]);
        
    }

    /**
     * Updates an existing TbSchool model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //print_r($model);
       
        $model->img_id_old = $model->img_id;
        if ($model->load(Yii::$app->request->post())) {
             
            $post=Yii::$app->request->post();
            //$modelSchoolLevelJion->load(Yii::$app->request->post());
            //$modelSchoolLevelJion = Model::createMultiple(TbSchoolLevelJion::classname());
            //Model::loadMultiple($modelSchoolLevelJion, Yii::$app->request->post());
           
            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    //ActiveForm::validateMultiple($modelSchoolLevelJion),
                  // ActiveForm::validate($modelSchoolLevelJion),
                   ActiveForm::validate($model)
                );
            }
            //print_r($post);
            //print_r($model->school_level_id);
            //exit();
            // validate all models
            $valid = $model->validate();  
            //$valid = $modelSchoolLevelJion->validate() && $valid;
            //echo $valid;
            
            if ($valid) {                
               $transaction = \Yii::$app->db->beginTransaction();
               
                try {
                    $model->school_title = str_replace($model->getAttributeLabel('school'), '', $model->school_title);
                    if ($flag = $model->save(false)) {                       
                        
                        
                        
                        if($levelJion=TbSchoolLevelJion::findOne(['school_id'=>$id])){
                            $levelJion->deleteAll();
                        }
                        if($post['TbSchool']['school_level_id'])
                        foreach ($post['TbSchool']['school_level_id'] as $school_level_id) {
                            $modeJion=new TbSchoolLevelJion();
                            $modeJion->school_id = $model->school_id;
                            $modeJion->school_level_id= $school_level_id;
                            if (! ($flag = $modeJion->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {                       
                       $transaction->commit();  
                       
                       Yii::$app->img->clearTempImg($model->img_id,$model->img_id_old);  
                       Yii::$app->session->setFlash('success', Yii::t('app','บันทึกเรียบร้อย '.$model->img_id));
                        return $this->redirect(['view', 'id' => $model->school_id]);
                    }
                } catch (Exception $e) {
                     $error = $e->getMessage();
                   // print($flag . " - Failed: " . $error . "!\n");
                    Yii::$app->session->setFlash('error', " - Failed: " . $error);
                    $transaction->rollBack();
                }
            }
           
        } 
        
        $modelSchoolLevelJion = TbSchoolLevelJion::find()->where(['school_id'=>$model->school_id])->all();
//$checkedFeatureArr = array();
        if($modelSchoolLevelJion){
            foreach ($modelSchoolLevelJion as $data) {
                $checkedFeatureArr[] = $data->school_level_id;
            }
            $model->school_level_id=$checkedFeatureArr;
        }
        
        
            return $this->render('update', [
                'model' => $model,
                //'modelSchoolLevelJion' => $modelSchoolLevelJion?$modelSchoolLevelJion:new TbSchoolLevelJion(),
            ]);
        
    }

    /**
     * Deletes an existing TbSchool model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        
        $LevelJion = TbSchoolLevelJion::findOne(['school_id' => $id]);
        if ($LevelJion) {
            if ($LevelJion->deleteAll()) {
                //$work[] = 'ลบข้อมูลการศึกษาแล้ว';
            }
        }
        
        $TbPersonnel= TbPersonnel::findOne(['school_id' => $id]);
        if ($TbPersonnel) {
            if ($TbPersonnel->deleteAll()) {
                //$work[] = 'ลบข้อมูลการศึกษาแล้ว';
            }
        }
        $model=$this->findModel($id);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TbSchool model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TbSchool the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TbSchool::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    #################################
    ##################################

    public function actionImg() {
        // print_r(Yii::$app->request->post())       
        $TbImages = new TbImages();
        $img = UploadedFile::getInstance($TbImages, 'img_name_file');

        if ($img) {
            //print_r($img);
            $pathImg = TbSchool::PATH_IMG;
            Yii::$app->img->CreateDir($pathImg);
            $savePath = Yii::$app->img->getUploadPath($pathImg);
            //echo $savePath;
            //exit();
            $FileName = $img->basename . '.' . $img->extension;
            $newFileName = md5($img->basename . time()) . '.' . $img->extension;
            if ($img->saveAs($savePath . $newFileName)) {
                #resize
                $image = Yii::$app->image->load($savePath . '/' . $newFileName);
                $image->resize(440,587);
                $image->save($savePath . '/' . $newFileName);
                #thumbnail
                $image = Yii::$app->image->load($savePath . '/' . $newFileName);
                $image->resize(100,100);
                $image->save($savePath . '/thumbnail/' . $newFileName);
                
                Yii::$app->img->clearTempImg();

                $TbImages->img_id = $newFileName;
                $TbImages->img_name_file = $FileName;
                $TbImages->img_path_file = $pathImg;
                $TbImages->img_upload_date = date("Y-m-d H:i:s");
                $TbImages->user_id = Yii::$app->user->id;
                $TbImages->img_temp = '1';

                if ($TbImages->save()) {
                    $src = Yii::$app->img->getUploadUrl($TbImages->img_path_file) . $TbImages->img_id;
                    echo json_encode(['success' => 'true', 'src' => $src, 'img_id' => $TbImages->img_id]);
                } else {
                    print_r($TbImages->getErrors());
                    echo json_encode(['success' => 'true']);
                }
            } else {
                echo json_encode(['success' => 'false', 'img1' => $img]);
            }
        } else {
            echo json_encode(['success' => 'false', 'img2' => $img]);
        }
    }
    
}
