<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Html;
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
use backend\modules\persons\models\TbPersonSearch;
use yii\data\ActiveDataProvider;
use yii\base\Model;

class ActivityController extends \yii\web\Controller {

    use AjaxValidationTrait;

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex() {
        $searchModel = new TbActivitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where('activity_status = "1"');

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id) {        
        return $this->render('view', [
                    'model' => TbActivity::find($id)->one(),
                    
        ]);





//        return $this->render('view', [
//                    'model' => TbActivity::find($id)->one(),
//        ]);
    }

    public function actionRegisted($id, $person="") {
        if (isset($person)&&!empty($person)) {
            
            return $this->render('registed', [
                        'modelAct' => TbActivity::findOne($id),
                        'modelPerson' => TbPerson::findOne($person),
                        'modelStudy' => TbStudy::findOne(['person_id' => $person]),
                        'modelPersonnel' => TbPersonnel::findOne(['person_id' => $person]),
                        'modelTeach' => TbTeach::findOne(['person_id' => $person]),
            ]);
        } else {
            $searchModel = new TbPersonSearch();
            //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $param = Yii::$app->request->queryParams;

            $modelPerson = TbPerson::find()
                    ->innerJoinWith('tbActivityJoins')
                    ->with('tbPersonnels')
                    ->with('tbPersonnels.school')
                    //->leftJoin('tb_personnel','tb_personnel.person_id=tb_person.person_id')
                    ->where([
                        'tb_activity_join.activity_id' => $id,
                        //'tb_personnel.personnel_last' => '1'
                            ]);
            if (isset($param['TbPersonSearch'])) {
                $modelPerson->andWhere('person_name LIKE "%' . $param['TbPersonSearch']['fullName'] . '%" ' .
                        'OR person_surname LIKE "%' . $param['TbPersonSearch']['fullName'] . '%"');
                $modelPerson->andWhere('person_email LIKE "%' . $param['TbPersonSearch']['person_email'] . '%" ');
            }
            $dataProvider = new ActiveDataProvider([
                'query' => $modelPerson,
                'pagination' => [
                //'pageSize' => 20,
                ],
            ]);
            return $this->render('registedList', [
                        'model' => TbActivity::find($id)->one(),
                        'modelPerson' => $dataProvider,
                        'searchModel' => $searchModel
            ]);
        }
    }

    public function actionRegister($id) {
        $modelAct = TbActivity::findOne($id);

        $modelPerson = new TbPerson(['scenario' => 'register']);
        $modelStudy = new TbStudy(['scenario' => 'register']);
        $modelTeach = new TbTeach(['scenario' => 'register']);
        $modelPersonnel = new TbPersonnel(['scenario' => 'register']);
        $modelActivityJoin = new TbActivityJoin();


        $this->performAjaxValidation($modelPerson);
        $this->performAjaxValidation($modelStudy);
        $this->performAjaxValidation($modelTeach);
        $this->performAjaxValidation($modelPersonnel);
        //$this->pr(Yii::$app->request->post());
        //$this->performAjaxValidation($model);   
        //print_r(Yii::$app->request->post());
        $post = Yii::$app->request->post();
        $validates = [];
        //$this->pr($modelTeach->load($post));
        if ($modelPerson->load($post) &&
                $modelStudy->load($post) &&
                $modelPersonnel->load($post) &&
                $modelTeach->load($post) &&
                $validates = Model::validateMultiple([
                    $modelPerson,
                    //$modelStudy,
                    //$modelPersonnel,
                    //$modelTeach,
                    $modelAct
                ])) {


            //$this->pr($validates);
            $transaction = $modelPerson::getDb()->beginTransaction();

            try {

                if ($modelPerson->save()) {
                    //$this->pr($post);
                    $modelActivityJoin = new TbActivityJoin();
                    $modelActivityJoin->person_id = $modelPerson->person_id;
                    $modelActivityJoin->person_mode = 2;
                    $modelActivityJoin->link('activity', $modelAct);
                    $modelActivityJoin->save();


                    $modelTeach->person_id = $modelPerson->person_id;
                    $modelTeach->subject_id = $this->chkTb(TbSubject::className(), $post['TbTeach'], 'subject_id', 'subject_title');
                    $modelTeach->edu_class_id = $this->chkTb(TbEduClass::className(), $post['TbTeach'], 'edu_class_id', 'edu_class_title');
                    $modelTeach->save();

                    if($post['TbPersonnel']['school_id']){
                    $modelPersonnel->person_id = $modelPerson->person_id;
                    $modelPersonnel->personnel_last = '1';
                    $modelPersonnel->school_id = $this->chkTb(TbSchool::className(), $post['TbPersonnel'], 'school_id', 'school_title');
                    $modelPersonnel->position_id = $this->chkTb(TbPosition::className(), $post['TbPersonnel'], 'position_id', 'position_title');
                    $modelPersonnel->save();
                    }


                    if($post['TbStudy']['edu_level_id']&&
                       $post['TbStudy']['degree_id']
                    ){
                    $modelStudy->person_id = $modelPerson->person_id;
                    $modelStudy->edu_level_id = $this->chkTb(TbEduLevel::className(), $post['TbStudy'], 'edu_level_id', 'edu_level_title');
                    $modelStudy->edu_local_id = $this->chkTb(TbEduLocal::className(), $post['TbStudy'], 'edu_local_id', 'edu_local_title');
                    $modelStudy->degree_id = $this->chkTb(TbDegree::className(), $post['TbStudy'], 'degree_id', 'degree_title');
                    $modelStudy->major_id = $this->chkTb(TbMajor::className(), $post['TbStudy'], 'major_id', 'major_title');
                    $modelStudy->save();
                    }


                    //$modelActivityJoin->save();
//                     $this->pr($modelPersonnel->getErrors());
//                     $this->pr($modelStudy->getErrors());
//                     $this->pr($modelActivityJoin->getErrors());
                }
                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollBack();
                throw $e;
                //echo $e->getMessage();
                //print_r($modelPerson->getErrors()); 
                // exit();
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
            $Link = Yii::$app->urlManager->createAbsoluteUrl(['/activity/registed', 'id' => $modelAct->activity_id, 'person' => $modelPerson->person_id]);
            Yii::$app->session->setFlash('success', Yii::t('app', 'Success'));
            $content = "มีผู้มาสมัครลงทะเบียนตามลิงค์นี้ " . Html::a("ผู้สมัคร", $Link);

            Yii::$app->mailer->compose(
                            "@app/mail/layouts/register", [
                            "content" => $content
                            ]
                    )
                    ->setTo(Yii::$app->params['adminEmail'])
                    ->setFrom([$modelPerson->person_email => $modelPerson->person_email])
                    ->setSubject('ลงทะเบียน')
                    ->setTextBody($content . "123")
                    ->send();



            return $this->redirect(['registed', 'id' => $modelAct->activity_id, 'person' => $modelPerson->person_id]);
        } else {
//            $this->pr($validates);
//            $this->pr($modelPerson->getErrors());
//            $this->pr($modelPersonnel->getErrors());
//            $this->pr($modelStudy->getErrors());
//            $this->pr($modelActivityJoin->getErrors());
            return $this->render('register', [
                        'model' => $modelPerson,
                        'modelAct' => $modelAct,
                        'modelStudy' => $modelStudy,
                        'modelTeach' => $modelTeach,
                        'modelPersonnel' => $modelPersonnel,
                            //'modelActivityJoin' => $modelActivityJoin,
            ]);
        }

        //return $this->render('register');
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

    public function pr($arr) {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }

}
