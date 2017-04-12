<?php

namespace backend\modules\persons\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use beastbytes\wizard\WizardBehavior;
use yii\helpers\Url;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use common\traits\AjaxValidationTrait;
use backend\modules\slide\models\TbImages;
use backend\modules\persons\models\Model;
use backend\modules\persons\models\TbPerson;
use backend\modules\persons\models\TbPersonSearch;
use backend\modules\persons\models\TbAddress;
//use backend\modules\persons\models\activity\TbActivityJoin;
use backend\modules\persons\models\teach\TbTeach;
use backend\modules\user\models\TbUserProfile;
use backend\modules\persons\models\education\TbStudy;
use backend\modules\persons\models\teach\TbPersonnel;
use backend\modules\persons\models\teacher\TbClassTeacher;
use backend\modules\persons\models\activity\TbActivity;
use backend\modules\persons\models\activity\TbActivityJoin;
use backend\modules\persons\models\teach\TbSubject;
use backend\modules\persons\models\education\TbDegree;
use backend\modules\persons\models\education\TbEduLocal;
use backend\modules\persons\models\education\TbMajor;
use backend\modules\persons\models\teach\TbEduClass;


/**
 * DefaultController implements the CRUD actions for TbPerson model.
 */
class DefaultController extends Controller {

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
     * Lists all TbPerson models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TbPersonSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    public function chk_address($id){
        $addressCk = TbAddress::find()
                ->where(['person_id' => $id])
                ->one();
        if (empty($addressCk) && $id) {
            //print_r(TbAddress::itemAlias('address_on'))
            foreach (TbAddress::itemsAlias('address_on') as $key => $val) {
                //$model = [new TbAddress];
                //echo $key . $val." ";
                $model = new TbAddress();
                $model->person_id = $id;
                $model->address_on = (String) $key;
                if (!$model->save()) {
                    print_r($model->getErrors());
                }
            }
        }
    }
    public function actionProfile($id) {
        $this->chk_address($id);
        ################################################
        $address = TbAddress::find()
                ->where(['person_id' => $id])
                ->orderBy(['address_on' => 'DESC'])
                ->all();
        $modelAddress = TbAddress::find()
                ->where(['person_id' => $id]);
        $dataProviderAddress = new ActiveDataProvider([
            'query' => $modelAddress,
            'pagination' => [
            //'pageSize' => 20,
            ],
        ]);
        ######################
        $modelsStudy = TbStudy::find()
                ->where(['person_id' => $id]);
        $dataProviderStudy = new ActiveDataProvider([
            'query' => $modelsStudy,
            'pagination' => [
            //'pageSize' => 20,
            ],
        ]);


        $modelClassPersonnel = TbPersonnel::find()
                ->where(['person_id' => $id]);
        $dataProviderPersonnel = new ActiveDataProvider([
            'query' => $modelClassPersonnel,
            'pagination' => [
            ],
        ]);

        $modelClassTeacher = TbClassTeacher::find()
                ->where(['person_id' => $id]);
        $dataProviderClassTeacher = new ActiveDataProvider([
            'query' => $modelClassTeacher,
            'pagination' => [
            ],
        ]);
        $modelTeach = TbTeach::find()
                ->where(['person_id' => $id]);
        $dataProviderTeach = new ActiveDataProvider([
            'query' => $modelTeach,
            'pagination' => [
            ],
        ]);
        $modelActivity = TbActivityJoin::find()
                ->with('activity')
                //->with('location')
                ->where(['person_id' => $id]);
        $dataProviderActivity = new ActiveDataProvider([
            'query' => $modelActivity,
            'pagination' => [
            ],
        ]);

        return $this->render('profile', [
                    'person' => $this->findModel($id),
                    'address' => $dataProviderAddress,
                    'study' => $dataProviderStudy,
                    'personnel' => $dataProviderPersonnel,
                    'teacher' => $dataProviderClassTeacher,
                    'teach' => $dataProviderTeach,
                    'activity' => $dataProviderActivity,
        ]);
    }

    /**
     * Displays a single TbPerson model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $address = TbAddress::find()
                ->where(['person_id' => $id])
                ->orderBy('address_on')
                ->all();
        return $this->redirect(['/persons/default/profile/', 'id' => $id]);
//        return $this->render('view', [
//                    'model' => $this->findModel($id),
//                    'address' => $address,
//        ]);
    }

    public function actionImg($id) {
        // print_r(Yii::$app->request->post());
        $model = $this->findModel($id);
        $model->scenario = 'update';
        $TbImages = new TbImages();


        $img = UploadedFile::getInstance($TbImages,'img_name_file');

        if ($img) {
            //print_r($img);
            $pathImg='persons';
            Yii::$app->img->CreateDir($pathImg);
            $savePath = Yii::$app->img->getUploadPath($pathImg);
            //echo $savePath;
            //exit();
            $FileName = $img->basename.'.'.$img->extension;
            $newFileName = md5($img->basename.time()).'.'.$img->extension;
            if ($img->saveAs($savePath . $newFileName)) {
                if($model->img_id){
                    TbImages::findOne($model->img_id)->delete();
                    @unlink($savePath . $model->img_id);
                }
                
                
                $TbImages->img_id=$newFileName;
                $TbImages->img_name_file=$FileName;
                $TbImages->img_path_file=$pathImg;
                $TbImages->img_upload_date=date("Y-m-d H:i:s");
                $TbImages->user_id=Yii::$app->user->id;
                            
                $model->img_id=$TbImages->img_id;  
                if($TbImages->save()&&$model->save()){
                    echo json_encode(['success' => 'true','img_id'=>$TbImages->img_id]);
                    //return $this->redirect(['/persons/default/profile/', 'id' => $id]);
                }else{
                    print_r($TbImages->getErrors());
                    print_r($model->getErrors());
                    echo json_encode(['success' => 'true']);
                }
            } else {
                echo json_encode(['success' => 'false','img1'=>$img]);
            }
        } else {
            echo json_encode(['success' => 'false','img2'=>$img]);
        }
    }
    
    public function actionSelectImg($id) {
        $model = $this->findModel($id);
        $src =Yii::$app->img->getUploadUrl($model->img->img_path_file). $model->img->img_id;
        echo json_encode(['src' => $src]);
    }
    
   public function actionUploadImg() {
        // print_r(Yii::$app->request->post());
        
        $TbImages = new TbImages();


        $img = UploadedFile::getInstance($TbImages,'img_name_file');
        if ($img) {
            //print_r($img);
            $pathImg='persons';
            Yii::$app->img->CreateDir($pathImg);
            $savePath = Yii::$app->img->getUploadPath($pathImg);
            //echo $savePath;
            //exit();
            $FileName = $img->basename.'.'.$img->extension;
            $newFileName = md5($img->basename.time()).'.'.$img->extension;
            if ($img->saveAs($savePath . $newFileName)) {
                
                if($model->img_id){
                    TbImages::findOne($model->img_id)->delete();
                    @unlink($savePath . $model->img_id);
                }
                
                if($deletedImg = TbImages::find(['user_id' =>  Yii::$app->user->id,'img_temp'=>1])){
                    foreach($deletedImg->all() as $modelImg){
                       @unlink($modelImg->img_patch . $modelImg->img_id); 
                    }
                    $deletedImg->deleteAll();                   
                }
                 $TbImages->img_id=$newFileName;
                $TbImages->img_name_file=$FileName;
                $TbImages->img_path_file=$pathImg;
                $TbImages->img_upload_date=date("Y-m-d H:i:s");
                $TbImages->user_id=Yii::$app->user->id;
              
                            
                $TbImages->img_id;  
                if($TbImages->save()){
                    echo json_encode(['success' => 'true','img_id'=>$TbImages->img_id]);
                    //return $this->redirect(['/persons/default/profile/', 'id' => $id]);
                }else{
                    print_r($TbImages->getErrors());
                    print_r($model->getErrors());
                    echo json_encode(['success' => 'true']);
                }
            } else {
                echo json_encode(['success' => 'false','img1'=>$img]);
            }
        } else {
            echo json_encode(['success' => 'false','img2'=>$img]);
        }
    }


    /**
     * Creates a new TbPerson model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TbPerson();
        $model->scenario = 'create';
        
        $this->performAjaxValidation($model);
        
        if ($model->load(Yii::$app->request->post())) {
            $model->person_create_at = time();
            if ($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app','สร้างบุคคลนี้เรียบร้อย'));
                return $this->redirect(['update', 'id' => $model->person_id]);
            }else{
                 Yii::$app->session->setFlash('error', Yii::t('app','พบปัญหาให้การสร้าง'));
            }
        } else {
            return $this->render('create', [
                        'modelPerson' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TbPerson model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        //echo $id;
        $modelPerson = $this->findModel($id);
        $modelPerson->scenario = 'update'; 
        ####### Address ###################################
        $this->chk_address($id);        
        $modelsAddress = $modelPerson->tbAddresses;        
        ####### Study #################################
        //print_r($modelPerson->tbStudies);        
        if(!empty($modelPerson->tbStudies)){
        $modelsStudy = $modelPerson->tbStudies;
        }else{
        $modelsStudy = [new TbStudy(['scenario' => 'register'])];       
        }
        //print_r($modelsStudy);
        //exit();
        ####### Personnel #################################
        //print_r($modelPerson->tbPersonnels);
        if(!empty($modelPerson->tbPersonnels)){
        $modelsPersonnel = $modelPerson->tbPersonnels;
        }else{
        $modelsPersonnel = [new TbPersonnel(['scenario' => 'register'])];       
        }
        ####### ClassTeachers #################################
        //print_r($modelPerson->tbPersonnels);
        if(!empty($modelPerson->tbClassTeachers)){
        $modelsClassTeachers = $modelPerson->tbClassTeachers;
        }else{
        $modelsClassTeachers = [new TbClassTeacher()];       
        }
        ####### Teach #################################
        //print_r($modelPerson->tbPersonnels);
        if(!empty($modelPerson->tbTeaches)){
        $modelsTeach = $modelPerson->tbTeaches;
        }else{
        $modelsTeach = [new TbTeach(['scenario' => 'register'])];       
        }
        
        ####### Activity #################################
        //print_r($modelPerson->tbPersonnels);
        if(!empty($modelPerson->tbActivityJoins)){
        $modelsActivityJoin = $modelPerson->tbActivityJoins;
        }else{
        $modelsActivityJoin = [new TbActivityJoin()];       
        }
        
       
        ################################################
        
        // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsAddress),
                    ActiveForm::validateMultiple($modelsStudy),
                    ActiveForm::validateMultiple($modelsPersonnel),
                    ActiveForm::validateMultiple($modelsClassTeachers),
                    ActiveForm::validateMultiple($modelsTeach),
                    ActiveForm::validateMultiple($modelsActivityJoin),
                    ActiveForm::validate($modelPerson)
                );
            }
            //print_r(Yii::$app->request->post());
           //exit();
         // Load   
        if ($modelPerson->load(Yii::$app->request->post())) {       
            $post=Yii::$app->request->post();
            //print_r($post);
           ###### address ####
            $old_address_id = ArrayHelper::map($modelsAddress, 'address_id', 'address_id');
            $modelsAddress = Model::createMultiple(TbAddress::classname());
            Model::loadMultiple($modelsAddress, Yii::$app->request->post());
            $deletedAddressId = array_diff($old_address_id, array_filter(ArrayHelper::map($modelsAddress, 'address_id', 'address_id')));
            
            ##### study #####            
            $old_study_id = ArrayHelper::map($modelsStudy, 'study_id', 'study_id');
            $modelsStudy = Model::createMultiple(TbStudy::classname());
            Model::loadMultiple($modelsStudy, Yii::$app->request->post());
            $deletedStudyId = array_diff($old_study_id, array_filter(ArrayHelper::map($modelsStudy, 'study_id', 'study_id')));
            
            ##### personnel #####            
            $old_personnel_id = ArrayHelper::map($modelsPersonnel, 'personnel_id', 'personnel_id');
            $modelsPersonnel = Model::createMultiple(TbPersonnel::classname());
            Model::loadMultiple($modelsPersonnel, Yii::$app->request->post());
            $deletedPersonnelId = array_diff($old_personnel_id, array_filter(ArrayHelper::map($modelsPersonnel, 'personnel_id', 'personnel_id')));
            
            ##### ClassTeachers #####            
            $old_class_id = ArrayHelper::map($modelsClassTeachers, 'class_id', 'class_id');
            $modelsClassTeachers = Model::createMultiple(TbClassTeacher::classname());
            Model::loadMultiple($modelsClassTeachers, Yii::$app->request->post());
            $deletedClassId = array_diff($old_class_id, array_filter(ArrayHelper::map($modelsClassTeachers, 'class_id', 'class_id')));
            
            ##### Teach #####            
            $old_teach_id = ArrayHelper::map($modelsTeach, 'teach_id', 'teach_id');
            $modelsTeach = Model::createMultiple(TbTeach::classname());
            Model::loadMultiple($modelsTeach, Yii::$app->request->post());
            $deletedTeachId = array_diff($old_teach_id, array_filter(ArrayHelper::map($modelsTeach, 'teach_id', 'teach_id')));
                      
            ##### Teach #####     
            $modelsActivityJoin = Model::createMultiple(TbActivityJoin::classname());
            Model::loadMultiple($modelsActivityJoin, Yii::$app->request->post());
            
            $valid = $modelPerson->validate();
            $valid = Model::validateMultiple($modelsAddress) && $valid;
            $valid = Model::validateMultiple($modelsStudy) && $valid;
            $valid = Model::validateMultiple($modelsPersonnel) && $valid;
            $valid = Model::validateMultiple($modelsClassTeachers) && $valid;
            $valid = Model::validateMultiple($modelsTeach) && $valid;
            $valid = Model::validateMultiple($modelsActivityJoin) && $valid;
            
             if ($valid) {                
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                   
                    if ($flag = $modelPerson->save(false)) {   
                        ###### address ####
                         if (! empty($deletedAddressId)) {
                             TbAddress::deleteAll(['address_id' => $deletedAddressId]);
                        }                       
                        foreach ($modelsAddress as $modelAddress) {
                            if($modelAddress->address_id)
                            $modelAddress->address_id = $modelAddress->address_id;
                            $modelAddress->person_id = $modelPerson->person_id;
                            if (! ($flag = $modelAddress->save(false))) {
                                print_r($modelAddress->getErrors());
                                $transaction->rollBack();
                                break;
                            }
                        }
                             
                        ##### study #####
                        if (! empty($deletedStudyId)) {
                            TbStudy::deleteAll(['study_id' => $deletedStudyId]);
                        }
                        foreach ($modelsStudy as $key => $modelStudy) {
                            if($modelStudy->study_id)
                            $modelStudy->study_id = $modelStudy->study_id;
                            $modelStudy->person_id = $modelPerson->person_id;
                            $modelStudy->degree_id = $this->chkTb(TbDegree::className(), $post['TbStudy'][$key], 'degree_id', 'degree_title');
                            $modelStudy->major_id = $this->chkTb(TbMajor::className(), $post['TbStudy'][$key], 'major_id', 'major_title');
                            $modelStudy->edu_local_id = $this->chkTb(TbEduLocal::className(), $post['TbStudy'][$key], 'edu_local_id', 'edu_local_title');
                            
                            if (! ($flag = $modelStudy->save(false))) {
                                print_r($modelStudy->getErrors());
                                $transaction->rollBack();
                                break;
                            }
                        }    
                        
                        ##### Personnel #####
                        if (! empty($deletedPersonnelId)) {
                            TbPersonnel::deleteAll(['personnel_id' => $deletedPersonnelId]);
                        }
                        foreach ($modelsPersonnel as $modelPersonnel) {
                            if($modelPersonnel->personnel_start){
                            if($modelPersonnel->personnel_id)
                            $modelPersonnel->personnel_id = $modelPersonnel->personnel_id;
                            $modelPersonnel->person_id = $modelPerson->person_id;
                            if (! ($flag = $modelPersonnel->save(false))) {
                                print_r($modelPersonnel->getErrors());
                                $transaction->rollBack();
                                break;
                            }
                            }
                        }    
                         
                        
                        ##### Teacher #####
                        if (! empty($deletedClassId)) {
                            TbClassTeacher::deleteAll(['class_id' => $deletedClassId]);
                        }
                        foreach ($modelsClassTeachers as $key => $modelClassTeachers) {
                            if($modelClassTeachers->class_id)
                            $modelClassTeachers->class_id = $modelClassTeachers->class_id;
                            $modelClassTeachers->person_id = $modelPerson->person_id;
                            //print_r($post['TbClassTeacher']);
                            //exit();
                            
                            $modelClassTeachers->edu_class_id = $this->chkTb(TbEduClass::className(), $post['TbClassTeacher'][$key], 'edu_class_id', 'edu_class_title');
                            if (! ($flag = $modelClassTeachers->save(false))) {
                                print_r($modelClassTeachers->getErrors());
                                $transaction->rollBack();
                                break;
                            }
                        }    
                         
                        ##### Teach #####
                        if (! empty($deletedTeachId)) {
                            TbTeach::deleteAll(['teach_id' => $deletedTeachId]);
                        }
                        foreach ($modelsTeach as $key=>$modelTeach) {
                            if($modelTeach->teach_id)
                            $modelTeach->teach_id = $modelTeach->teach_id;
                            $modelTeach->person_id = $modelPerson->person_id;
                            $modelClassTeachers->edu_class_id = $this->chkTb(TbEduClass::className(), $post['TbClassTeacher'][$key], 'edu_class_id', 'edu_class_title');
                            $modelTeach->subject_id = $this->chkTb(TbSubject::className(), $post['TbTeach'][$key], 'subject_id', 'subject_title');
                            if (! ($flag = $modelTeach->save(false))) { 
                                print_r($modelTeach->getErrors());
                                $transaction->rollBack();
                                break;
                            }
                        }    
                        
                        ##### ActivityJoin #####
                        if (! empty($modelPerson->person_id)) {
                            TbActivityJoin::deleteAll(['person_id' => $modelPerson->person_id]);
                        }
                        if(!empty($modelsActivityJoin[0]['activity_id'])){
                        foreach ($modelsActivityJoin as $modelActivityJoin) {                           
                            $modelActivityJoin->person_id = $modelPerson->person_id;
                            if (! ($flag = $modelActivityJoin->save(false))) {                                
                                print_r($modelActivityJoin->getErrors());
                                $transaction->rollBack();
                                break;
                            }
                        }
                        }                   
                       
                    }                    
                    
                    
                    if ($flag) {
                        $transaction->commit();     
                        Yii::$app->session->setFlash('success', Yii::t('app','บันทึกเรียบร้อย'));
                       // print_r(Yii::$app->request->post());
                        //exit();
                        if(Yii::$app->request->post('save')){
                            return $this->redirect(['update', 'id' => $modelPerson->person_id]);
                        }else if(Yii::$app->request->post('saveClose')){
                            return $this->redirect(['index']);    
                        }
                    }
                } catch (Exception $e) {
                    $error = $e->getMessage();
                   // print($flag . " - Failed: " . $error . "!\n");
                    Yii::$app->session->setFlash('error', " - Failed: " . $error);
                    $transaction->rollBack();   
                    
                }
            }      
         }
            return $this->render('update', [
                    'modelPerson' => $modelPerson,
                    'modelAddress' => $modelsAddress,
                    'modelsStudy'=> $modelsStudy,
                    'modelPersonnel' => $modelsPersonnel,
                    'modelsClassTeachers' => $modelsClassTeachers,
                    'modelsTeach' => $modelsTeach,
                    'modelsActivityJoin' => $modelsActivityJoin,
            ]);
        
    }

    /**
     * Deletes an existing TbPerson model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $work = [];
        $notWork = [];
        //TbAddress::findOne(['person_id' => $id])->delete();
        $address = TbAddress::findOne(['person_id' => $id]);
        if ($address) {
            if ($address->deleteAll()) {
                $work[] = 'ลบข้อมูลที่อยู่แล้ว';
            }
        }

        $activityJoin = TbActivityJoin::findOne(['person_id' => $id]);
        if ($activityJoin) {
            if ($activityJoin->deleteAll()) {
                $work[] = 'ลบข้อมูลกิจกรรมแล้ว';
            }
        }

        //TbStudy::findOne(['person_id' => $id])->delete();
        $personnel = TbPersonnel::findOne(['person_id' => $id]);
        if ($personnel) {
            if ($personnel->delete()) {
                $work[] = 'ลบข้อมูลการทำงานแล้ว';
            }
        }
        
        $study = TbStudy::findOne(['person_id' => $id]);
        if ($study) {
            if ($study->delete()) {
                $work[] = 'ลบข้อมูลการศึกษาแล้ว';
            }
        }
        
        
        if($model->img_id){
            TbImages::findOne($model->img_id)->delete();
            @unlink(Yii::$app->img->getUploadPath('persons') . $model->img_id);
        }
        

        if ($model->delete()) {
            Yii::$app->session->setFlash('success', implode(', ', $work));
        } else {
            Yii::$app->session->setFlash('error', 'There was an error sending email.');
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the TbPerson model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TbPerson the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TbPerson::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    ################################################################
    ################################################################
    ################################################################
     public function chkTb($modelName, $val, $id, $title) {
        if (isset($val[$id])) {
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
    }
   
    public function actionValue() {
        return $this->render('value');
    }
}
