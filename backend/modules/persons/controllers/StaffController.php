<?php

namespace backend\modules\persons\controllers;

use Yii;
use beastbytes\wizard\WizardBehavior;
use common\traits\AjaxValidationTrait;
use backend\modules\persons\models\TbPerson;
use backend\modules\persons\models\TbPersonSearch;
use backend\modules\persons\models\TbAddress;
use backend\modules\persons\models\education\TbStudy;
use backend\modules\persons\models\Model;
//use yii\base\Model;

class StaffController extends \yii\web\Controller {

    use AjaxValidationTrait;

    public function beforeAction($action) {
        $config = [];
        switch ($action->id) {
            case 'registration':
                $config = [
                    'steps' => [
                        'general', 'address', 'education', 'performance'
                    ],
                    'events' => [
                        WizardBehavior::EVENT_WIZARD_STEP => [$this, $action->id . 'WizardStep'],
                        WizardBehavior::EVENT_AFTER_WIZARD => [$this, $action->id . 'AfterWizard'],
                        WizardBehavior::EVENT_INVALID_STEP => [$this, 'invalidStep']
                    ]
                ];
                break;

            default:
                break;
        }

        if (!empty($config)) {
            $config['class'] = WizardBehavior::className();
            $this->attachBehavior('wizard', $config);
        }

        return parent::beforeAction($action);
    }

    public function actionRegistration($step = null) {
        if ($step === null)
            $this->resetWizard();
        return $this->step($step);
    }

    public function registrationAfterWizard($event) {
        if (is_string($event->step)) {
            $uuid = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
            );

            $registrationDir = Yii::getAlias('@runtime/registration');
            $registrationDirReady = true;
            if (!file_exists($registrationDir)) {
                if (!mkdir($registrationDir) || !chmod($registrationDir, 0775)) {
                    $registrationDirReady = false;
                }
            }
            if ($registrationDirReady && file_put_contents(
                            $registrationDir . DIRECTORY_SEPARATOR . $uuid, $event->sender->pauseWizard()
                    )) {
                $event->data = $this->render('registration\\paused', compact('uuid'));
            } else {
                $event->data = $this->render('registration\\notPaused');
            }
        } elseif ($event->step === null) {
            $event->data = $this->render('registration\\cancelled');
        } elseif ($event->step) {
            $transaction = Yii::$app->db->beginTransaction();

            $person = $event->stepData['general'][0];
            $address = $event->stepData['address'][0];

            try {
                if (!$person->save()) {
                    print_r($person->getErrors());
                    throw new Exception('Model cannot be saved.');
                }
                //$id=$person->person_id;
//                $address->person_id=$person->person_id;
//                if (!$address->save()) {
//                    print_r($person->getErrors());
//                    throw new Exception('Anothermodel cannot be saved.');
//                }
                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollback();
            }

//            if($person->save()){
//                
//            }else{                
//                print_r($person->getErrors());
//            }
            // echo "</pre>";
            return Yii::$app->response->redirect(Url::to(['profile', 'id' => $person->person_id]));
//            $event->data = $this->render('view', [
//               'data' => $event->stepData
//            ]);
        } else {
            $event->data = $this->render('registration\\notStarted');
        }
    }

    /**
     * 
     */
    public function registrationWizardStep($event) {
        //echo ucfirst($event->step);
        if (empty($event->stepData)) {
            $model = [];
            $modelName = '';
            // echo $event->step;
            switch ($event->step) {
//                case 'address':
//                    $modelName = 'backend\\modules\\persons\\models\\wizard\\registration\\'.ucfirst($event->step); 
//                    $model = [new $modelName];                                        
//                break;
//
//                case 'education':
//
//                    $model = [new TbStudy];
//                    // $this->performAjaxValidation($model);                        
//                    break;

                default :
                    $modelName = 'backend\\modules\\persons\\models\\wizard\\registration\\' . ucfirst($event->step);
                    $model = new $modelName();
                    $this->performAjaxValidation($model);
                    break;
            }

//            $modelName = 'backend\\modules\\persons\\models\\wizard\\registration\\'.ucfirst($event->step);
//            //echo $modelName;                    
//            $model = new $modelName();
//            $this->performAjaxValidation($model);
        } else {
            $model = $event->stepData;
        }

        $post = Yii::$app->request->post();
//       print_r($post);
//        exit();
        if (isset($post['cancel'])) {
            $event->continue = false;
        } elseif (isset($post['prev'])) {
            $event->nextStep = WizardBehavior::DIRECTION_BACKWARD;
            $event->handled = true;
        } elseif ($event->step == 'address') {

            $modelName = 'backend\\modules\\persons\\models\\wizard\\registration\\' . ucfirst($event->step);
            
            if ($model = Model::createMultiple($modelName::classname())) {
                //Model::loadMultiple($model, Yii::$app->request->post());
                $event->handled = true;
                $event->data = $model;
                //print_r($event->data);

                if (isset($post['pause'])) {
                    $event->continue = false;
                } elseif ($event->n < 2 && isset($post['add'])) {
                    $event->nextStep = WizardBehavior::DIRECTION_REPEAT;
                }
            }

            $event->data = $this->render($event->step, compact('event', 'model'));
        } elseif ($model->load($post) && $model->validate()) {
            $event->data = $model;
            $event->handled = true;

            if (isset($post['pause'])) {
                $event->continue = false;
            } elseif ($event->n < 2 && isset($post['add'])) {
                $event->nextStep = WizardBehavior::DIRECTION_REPEAT;
            }
        } else {
            $event->data = $this->render($event->step, compact('event', 'model'));
        }
    }

}
