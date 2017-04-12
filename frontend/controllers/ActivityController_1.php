<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\persons\models\activity\TbActivity;
use backend\modules\persons\models\activity\TbActivitySearch;
use frontend\models\Person;
use common\traits\AjaxValidationTrait;
use backend\modules\persons\models\TbPerson;
use backend\modules\persons\models\activity\TbActivityJoin;
use backend\modules\persons\models\education\TbStudy;
use backend\modules\persons\models\teach\TbTeach;
use backend\modules\persons\models\teach\TbPersonnel;

use backend\modules\persons\models\education\TbEduLevel;
use backend\modules\persons\models\education\TbEduLocal;
use backend\modules\persons\models\education\TbDegree;
use backend\modules\persons\models\education\TbMajor;
use backend\modules\persons\models\teach\TbSchool;
use backend\modules\persons\models\teach\TbSubject;
use backend\modules\persons\models\teach\TbEduClass;
use backend\modules\persons\models\TbPosition;
use yii\base\Model;

class ActivityController extends \yii\web\Controller {

    use AjaxValidationTrait;

    public function actionIndex() {
        $searchModel = new TbActivitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id) {
        return $this->render('view', [
                    'model' => TbActivity::find($id)->one(),
        ]);
    }

    public function actionRegisted($id,$person) {
        return $this->render('registed', [
            'modelAct' => TbActivity::findOne($id),
            'modelPerson' => TbPerson::findOne($person),
            'modelStudy' => TbStudy::findOne(['person_id'=>$person]),
            'modelPersonnel' => TbPersonnel::findOne(['person_id'=>$person]),
            'modelTeach' => TbTeach::findOne(['person_id'=>$person]),
        ]);
    }
    public function actionRegister($id) {
        $modelAct = TbActivity::findOne($id);

        $modelPerson = new TbPerson(['scenario' => 'register']);
        $modelStudy = new TbStudy();
        $modelActivityJoin = new TbActivityJoin();
        $modelTeach = new TbTeach();
        $modelPersonnel = new TbPersonnel(['scenario' => 'register']);
        
       // $this->pr(Yii::$app->request->post());
       
        //$this->performAjaxValidation($model);   
        print_r(Yii::$app->request->post());
        $post=Yii::$app->request->post();
        $validates=[];
        $this->pr($modelTeach->load($post));
        if ($modelPerson->load($post) &&
                $modelAct->load($post) &&
                $modelStudy->load($post) &&  
                $modelPersonnel->load($post) &&
                $modelTeach->load($post) &&
                $validates=Model::validateMultiple([
                    $modelPerson,
                    $modelStudy,
                    $modelPersonnel,
                    $modelTeach,
                    $modelAct
                ])) {
              
                
               // $this->pr($validates);
            $transaction = $modelPerson::getDb()->beginTransaction();
            
            try {
                
                if ($modelPerson->save()) { 
                    //$this->pr($post);
                   
                    $modelTeach->person_id = $modelPerson->person_id;
                    $modelTeach->subject_id = $this->chkTb(TbSubject::className(),$post['TbTeach'], 'subject_id', 'subject_title');
                    $modelTeach->edu_class_id = $this->chkTb(TbEduClass::className(),$post['TbTeach'], 'edu_class_id', 'edu_class_title');
                    //$modelTeach->save();
                   
                    $modelPersonnel->person_id = $modelPerson->person_id;
                    $modelPersonnel->school_id = $this->chkTb(TbSchool::className(),$post['TbPersonnel'], 'school_id', 'school_title');
                    $modelPersonnel->position_id = $this->chkTb(TbPosition::className(),$post['TbPersonnel'], 'position_id', 'position_title');
                    //$modelPersonnel->save();
                    
                    
                    $modelStudy->person_id = $modelPerson->person_id;
                    $modelStudy->edu_level_id = $this->chkTb(TbEduLevel::className(),$post['TbStudy'], 'edu_level_id', 'edu_level_title');
                    $modelStudy->edu_local_id = $this->chkTb(TbEduLocal::className(),$post['TbStudy'], 'edu_local_id', 'edu_local_title');
                    $modelStudy->degree_id = $this->chkTb(TbDegree::className(),$post['TbStudy'], 'degree_id', 'degree_title');
                    $modelStudy->major_id = $this->chkTb(TbMajor::className(),$post['TbStudy'], 'major_id', 'major_title');
                    //$modelStudy->save();
 
                    $modelActivityJoin = new TbActivityJoin();
                    $modelActivityJoin->person_id = $modelPerson->person_id;
                    $modelActivityJoin->pserson_mode = 2;
                    $modelActivityJoin->link('activity', $modelAct);                    
                    //$modelActivityJoin->save();

//                     $this->pr($modelPersonnel->getErrors());
//                     $this->pr($modelStudy->getErrors());
//                     $this->pr($modelActivityJoin->getErrors());
                }
                $transaction->commit();
            } catch (Exception $e) {               
                $transaction->rollBack();
                //throw $e;
                echo $e->getMessage();
                print_r($modelPerson->getErrors()); 
                exit();
            }
            return $this->redirect(['registed', 'id' => $modelAct->activity_id,'person' => $modelPerson->person_id]);
            exit();
        } else {
            //$this->pr($validates);
            //$this->pr($modelPerson->getErrors());
            return $this->render('register', [
                        'model' => $modelPerson,
                        'modelAct' => $modelAct,
                        'modelStudy' => $modelStudy,
                        //'modelActivityJoin' => $modelActivityJoin,
                        'modelTeach' => $modelTeach,
                        'modelPersonnel' => $modelPersonnel,
            ]);
            
        }
            
        //return $this->render('register');
    }
    
    public function chkTb($modelName, $val,$id, $title) {
        //$modelName = 'backend\\modules\\persons\\models\\activity\\' . $tb;
        $this->pr($val);
        $modelPost = new $modelName();
        $formName = $modelPost->formName();
        //echo $val=$val[$id];
        
        $model = $modelName::find()->where([$id=>$val])->one();
        //$this->pr($model);
        if (!$model) {
            $model = new $modelName();
            $model->$title = $val;
            if(!$model->save()){
                //print_r($model->getErrors());
                //exit();
            }
        }
        //echo $model->$id;
        return $model->$id;
    }
    
    public function pr($arr){
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }

}
