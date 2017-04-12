<?php

namespace backend\modules\user\models;

use Yii;
use backend\modules\slide\models\TbImages;
/**
 * This is the model class for table "tb_user_profile".
 *
 * @property integer $user_id
 * @property string $user_idcard
 * @property string $user_name
 * @property string $user_surname
 * @property string $user_nickname
 * @property integer $antecedent_id
 * @property string $user_sex
 * @property string $user_data
 * @property string $user_img
 * @property integer $person_id
 * @property string $user_phone
 * @property string $user_workstation
 *
 * @property TbAntecedent $antecedent
 * @property TbPerson $person
 * @property TbUser $user
 */
class TbUserProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_user_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'user_idcard', 'antecedent_id', 'person_id'], 'integer'],
            [['user_sex', 'user_data'], 'string'],
            [['user_name', 'user_surname'], 'string', 'max' => 30],
            [['user_nickname'], 'string', 'max' => 20],
            [['user_img'], 'string', 'max' => 200],
            [['user_phone'], 'string', 'max' => 33],
            [['user_workstation'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('person', 'รหัสผู้ใช้'),
            'user_idcard' => Yii::t('person', 'รหัสบัตรประชาชน'),
            'user_name' => Yii::t('person', 'ชื่อ'),
            'user_surname' => Yii::t('person', 'นามสกุล'),
            'user_nickname' => Yii::t('person', 'ชื่อเล่น'),
            'antecedent_id' => Yii::t('person', 'คำนำหน้า'),
            'user_sex' => Yii::t('person', 'เพศ'),
            'user_data' => Yii::t('person', 'ข้อมูลอื่นๆ'),
            'user_img' => Yii::t('person', 'User Img'),
            'person_id' => Yii::t('person', 'Person ID'),
            'user_phone' => Yii::t('person', 'User Phone'),
            'user_workstation' => Yii::t('person', 'User Workstation'),
        ];
    }
    public $user_img_old;
    const PATH_IMG='user';

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAntecedent()
    {
        return $this->hasOne(TbAntecedent::className(), ['antecedent_id' => 'antecedent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(TbPerson::className(), ['person_id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(TbUser::className(), ['user_id' => 'user_id']);
    }
     
    public function getImg()
    {        
        return $this->hasOne(TbImages::className(), ['img_id' => 'user_img']);
    }
}
