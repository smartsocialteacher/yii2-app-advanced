<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use backend\modules\persons\models\TbPerson;
use backend\modules\persons\models\activity\TbActivityJoin;
/**
 * Description of Person
 *
 * @author Madone
 */
class Person extends Model{
    //put your code here
    public $activity_id;
    
    public $person_id_card;
    public $person_name;
    public $person_surname;
    public $antecedent_id;
    public $person_sex;
    public $person_birthday;
    public $person_mobile;
    public $person_email;
    
    public $degree_id;
    public $major_id;
    public $edu_level_id;
   // public $person_email;

    


    public function rules() {
        return [
            [['person_name', 'person_surname'], 'required'  ],
            [['person_id_card'], 'unique'],
            [['position_id', 'antecedent_id', 'person_type_id', 'race_id', 'nationality_id', 'religion_id'], 'integer'],
            [['person_sex'], 'string'],
            [['person_birthday','fullName'], 'safe'],
            [['person_name', 'person_surname', 'person_email'], 'string', 'max' => 50],
          
            [['person_phone', 'person_mobile'], 'string', 'max' => 21],
            [['person_id_card'], 'validateIdCard'],
           // [['person_name','person_surname'], 'unique', 'targetAttribute' => ['person_name','person_surname']],
            [['antecedent_id', 'race_id', 'nationality_id', 'religion_id'], 'default', 'value' =>'1'],
            //[['position_id'], 'default', 'value' =>'6'],
            [['person_type_id'], 'default', 'value' =>'4'],

        ];
    }
    
    public function attributeLabels() {
        return [
            'person_id_card' => Yii::t('person', 'รหัสบัตรประชาชน'),
            'fullName'=> Yii::t('person', 'ชื่อ - นามสกุล'),
            'antecedent_id' => Yii::t('person', 'คำนำหน้า'),
            'person_name' => Yii::t('person', 'ชื่อ'),
            'person_surname' => Yii::t('person', 'นามสกุล'),
            'person_sex' => Yii::t('person', 'เพศ'),
            'person_birthday' => Yii::t('person', 'วันเกิด'),
            'person_mobile' => Yii::t('person', 'เบอร์มือถือ'),
            'person_email' => Yii::t('person', 'อีเมลล์'),
            'degree_id' => Yii::t('person', 'วุฒิการศึกษา'),
            'major_id' => Yii::t('person', 'สาขา'),
        ];
    }
    
    public function regiter()
    {
        if ($this->validate()) {
            $model = new TbPerson();
            $model->person_id_card = $this->person_id_card;
            $model->person_name = $this->person_name;
            $model->person_surname = $this->person_surname;
            $model->antecedent_id = $this->antecedent_id;
            $model->person_sex = $this->person_sex;
            $model->person_birthday = $this->person_birthday;
            $model->person_mobile = $this->person_mobile;
            $model->person_email = $this->person_email;
            
            
            

            if ($model->save()) {
                $actJion =new TbActivityJoin();
                $actJion->activity_id = $this->activity_id;
                $actJion->person_id = $model->person_id;
                $actJion->save();
                
                //return $user;
            }else{
                print_r($user->getErrors());
            }
        }

        return null;
    }
    public function validateIdCard($attribute, $params) {
        $this->$attribute = str_replace(['-', '_'], '', $this->$attribute);
        $model=TbPerson::findOne(['person_id_card'=> $this->$attribute]);
        if (strlen($this->$attribute) <= 12) {
            $this->addError($attribute, Yii::t('person', 'กรุณากรอกให้ครอบ 13 หลัก'));
        }elseif($model){
            $this->addError($attribute, Yii::t('person', 'รหัสบัตรนี้มีอยู่แล้ว'));
        }
    }
    
    public function chkTb($modelName, $val,$id, $title) {
        //$modelName = 'backend\\modules\\persons\\models\\activity\\' . $tb;
        $model = $modelName::find()->where([$id=>$val[$id]])->one();
        if (!$model) {
            $model = new $modelName();
            $model->$title = $val[$id];
            if(!$model->save()){
                print_r($model->getErrors());
                exit();
            }
        }
        return $model->$id;
    }
}
