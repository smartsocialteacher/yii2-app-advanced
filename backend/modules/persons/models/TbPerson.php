<?php

namespace backend\modules\persons\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\modules\persons\models\activity\TbActivityJoin;
use backend\modules\persons\models\education\TbStudy;
use backend\modules\persons\models\teach\TbPersonnel;
use backend\modules\persons\models\teacher\TbClassTeacher;
use backend\modules\persons\models\teach\TbTeach;
/**
 * This is the model class for table "tb_person".
 *
 * @property integer $person_id
 * @property string $person_id_card
 * @property integer $antecedent_id
 * @property string $person_name
 * @property string $person_surname
 * @property string $person_sex
 * @property string $person_birthday
 * @property string $person_blood_groups
 * @property string $person_phone
 * @property string $person_mobile
 * @property string $person_email
 * @property integer $position_id
 * @property integer $person_type_id
 * @property integer $race_id
 * @property integer $nationality_id
 * @property integer $religion_id
 *
 * @property TbActivityJoin[] $tbActivityJoins
 * @property TbAddress[] $tbAddresses
 * @property TbClassTeacher[] $tbClassTeachers
 * @property TbAntecedent $antecedent
 * @property TbNationality $nationality
 * @property TbPosition $position
 * @property TbRace $race
 * @property TbReligion $religion
 * @property TbPersonType $personType
 * @property TbPersonnel[] $tbPersonnels
 * @property TbStudy[] $tbStudies
 * @property TbTeach[] $tbTeaches
 * @property TbTrain[] $tbTrains
 * @property TbUserProfile[] $tbUserProfiles
 * @property TbUserProfilePsu[] $tbUserProfilePsus
 */
class TbPerson extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tb_person';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['person_name', 'person_surname','person_mobile','person_email'], 'required'  ],
            [['person_id_card'], 'unique'],
            [['position_id', 'antecedent_id', 'person_type_id', 'race_id', 'nationality_id', 'religion_id'], 'integer'],
            [['person_sex'], 'string'],
            [['person_birthday','fullName'], 'safe'],
            [['person_name', 'person_surname', 'person_email'], 'string', 'max' => 50],
            [['person_blood_groups'], 'string', 'max' => 2],
            [['person_phone', 'person_mobile'], 'string', 'max' => 21],
            [['person_id_card'], 'validateIdCard'],
            [['person_name','person_surname'], 'unique', 'targetAttribute' => ['person_name','person_surname'],'message'=>'ชื่อ-นามสกุลนี้ มีอยู่แล้ว'],
            [['antecedent_id', 'race_id', 'nationality_id'], 'default', 'value' =>'1'],
            [['religion_id'], 'default', 'value' =>'2'],
            [['position_id'], 'default', 'value' =>'6'],
            [['person_type_id'], 'default', 'value' =>'3'],

        ];
    }

    public function validateIdCard($attribute, $params) {
        //echo 44
        $this->$attribute = str_replace(['-', '_'], '', $this->$attribute);
        $model=TbPerson::findOne(['person_id_card'=> $this->$attribute]);
        if (strlen($this->$attribute) <= 12) {
            $this->addError($attribute, Yii::t('person', 'กรุณากรอกให้ครอบ 13 หลัก'));
        }elseif($model){
            $this->addError($attribute, Yii::t('person', 'รหัสบัตรนี้มีอยู่แล้ว'));
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'person_id' => Yii::t('person', 'รหัสบุคคล'),
            'person_id_card' => Yii::t('person', 'รหัสบัตรประชาชน'),
            'fullName'=> Yii::t('person', 'ชื่อ - นามสกุล'),
            'antecedent_id' => Yii::t('person', 'คำนำหน้า'),
            'person_name' => Yii::t('person', 'ชื่อ'),
            'person_surname' => Yii::t('person', 'นามสกุล'),
            'person_sex' => Yii::t('person', 'เพศ'),
            'person_birthday' => Yii::t('person', 'วันเกิด'),
            'person_blood_groups' => Yii::t('person', 'กรุ๊ปเลือด'),
            'person_phone' => Yii::t('person', 'โทรศัพท์'),
            'person_mobile' => Yii::t('person', 'เบอร์มือถือ'),
            'person_email' => Yii::t('person', 'อีเมลล์'),
            'position_id' => Yii::t('person', 'ตำแหน่ง'),
            'person_type_id' => Yii::t('person', 'ประเภทบุคลากร'),
            'race_id' => Yii::t('person', 'เชื้อชาติ'),
            'nationality_id' => Yii::t('person', 'สัญชาติ'),
            'religion_id' => Yii::t('person', 'ศาสนา'),
            'person_create_at' => Yii::t('person', 'สร้างเมื่อ'),
            'person_update_at' => Yii::t('person', 'ปรับปรุงเมื่อ'),
            'img_id' => Yii::t('person', 'รูปภาพ'),
            'image' => Yii::t('person', 'รูปประจำตัว'),
        ];
    }

    const SEX_MEN = 'M';
    const SEX_WOMEN = 'F';

    public function scenarios()
    {
        $scenarios = parent::scenarios();
         $scenarios['create'] = ['position_id','person_id_card','person_name', 'person_surname','position_id', 'antecedent_id', 'person_type_id', 'race_id', 'nationality_id', 'religion_id','person_sex','person_birthday','person_blood_groups', 'person_phone','person_mobile','person_email'];//
         
        $scenarios['update'] = ['position_id', 'antecedent_id', 'person_type_id', 'race_id', 'nationality_id', 'religion_id','person_sex','person_birthday','person_blood_groups', 'person_phone','person_mobile','person_email'];
        $scenarios['register'] = ['position_id','person_id_card','person_name', 'person_surname','position_id', 'antecedent_id', 'person_type_id', 'person_sex','person_birthday','person_mobile','person_email'];//Scenario Values Only Accepted
        return $scenarios;
    }
    
// ...

    public static function itemsAlias($key) {
        $items = [
            'sex' => [
                self::SEX_MEN => Yii::t('person', 'ชาย'),
                self::SEX_WOMEN => Yii::t('person', 'หญิง')
            ],
            'title' => [
                1 => 'นาย',
                2 => 'นางสาว',
                3 => 'นาง'
            ],
            'marital' => [
                1 => 'โสด',
                2 => 'สมรส',
                3 => 'เป็นหม้าย',
                4 => 'หย่าร้าง'
            ],
            'education' => [
                1 => 'ต่ำกว่ามัธยมศึกษาตอนต้น',
                2 => 'มัธยมศึกษาตอนต้น',
                3 => 'ปวช',
                4 => 'มัธยมศึกษาตอนปลาย',
                5 => 'ปวส',
                6 => 'อนุปริญญา',
                7 => 'ปริญญาตรี',
                8 => 'ปริญญาโท',
                9 => 'ปริญญาเอก'
            ],
            'blood_groups' => [
                'A' => 'A',
                'B' => 'B',
                'AB' => 'AB',
                'O' => 'O',
            ]
        ];
        return ArrayHelper::getValue($items, $key, []);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbActivityJoins() {
        return $this->hasMany(TbActivityJoin::className(), ['person_id' => 'person_id']);
    }
     
    public function getTbActivityJoin() {
        return $this->hasOne(TbActivityJoin::className(), ['person_id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbAddresses() {
        return $this->hasMany(TbAddress::className(), ['person_id' => 'person_id'])->orderBy(['address_on' => SORT_DESC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbClassTeachers() {
        return $this->hasMany(TbClassTeacher::className(), ['person_id' => 'person_id']);
    }
    
    public function getComments() {
        return $this->hasMany(TbPersonComment::className(), ['person_id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAntecedent() {
        return $this->hasOne(TbAntecedent::className(), ['antecedent_id' => 'antecedent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNationality() {
        return $this->hasOne(TbNationality::className(), ['nationality_id' => 'nationality_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosition() {
        return $this->position_id?$this->hasOne(TbPosition::className(), ['position_id' => 'position_id']):"";
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRace() {
        return $this->hasOne(TbRace::className(), ['race_id' => 'race_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReligion() {
        return $this->hasOne(TbReligion::className(), ['religion_id' => 'religion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getpersonType() {        
        return $this->hasOne(TbPersonType::className(), ['person_type_id' => 'person_type_id']);
    }
    public function getImg() {        
        return $this->hasOne(\backend\modules\slide\models\TbImages::className(), ['img_id' => 'img_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbPersonnels() {
        return $this->hasMany(TbPersonnel::className(), ['person_id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbStudies() {
        return $this->hasMany(TbStudy::className(), ['person_id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbTeaches() {
        return $this->hasMany(TbTeach::className(), ['person_id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbTrains() {
        return $this->hasMany(TbTrain::className(), ['person_id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbUserProfiles() {
        return $this->hasMany(TbUserProfile::className(), ['person_id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbUserProfilePsus() {
        return $this->hasMany(TbUserProfilePsu::className(), ['person_id' => 'person_id']);
    }

    ###############################################################
    ###############################################################

    public function getFullName() {
        return ($this->antecedent_id?$this->antecedent->antecedent_title:"")." ".$this->person_name . ' ' . $this->person_surname;
    }

    public function getSexName() {
        return ArrayHelper::getValue($this->getItemSex(), $this->person_sex);
    }

    ###############################################################
    ###############################################################

    public static function getItemSex() {
        return self::itemsAlias('sex');
    }

    public function getItemBloodGroups() {
        return self::itemsAlias('blood_groups');
    }
    
    public function getImage() {
        return (($this->img_id&&(Yii::$app->img->chkImg('persons',$this->img_id))) ? Yii::$app->img->getUploadUrl($this->img->img_path_file) . $this->img_id : Yii::$app->img->getNoimg());
    }

}
