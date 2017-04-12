<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "tb_user_profile_psu".
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
 *
 * @property TbAntecedent $antecedent
 * @property TbUser $user
 */
class TbUserProfilePsu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_user_profile_psu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['user_id'], 'required'],
            [['user_id', 'user_idcard', 'antecedent_id'], 'integer'],
            [['user_sex', 'user_data'], 'string'],
            [['user_name', 'user_surname'], 'string', 'max' => 30],
            [['user_nickname'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'รหัสผู้ใช้',
            'user_idcard' => 'รหัสบัตรประชาชน',
            'user_name' => 'ชื่อ',
            'user_surname' => 'นามสกุล',
            'user_nickname' => 'ชื่อเล่น',
            'antecedent_id' => 'คำนำหน้า',
            'user_sex' => 'เพศ',
            'user_data' => 'ข้อมูลอื่นๆ',
        ];
    }

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
    public function getUser()
    {
        return $this->hasOne(TbUser::className(), ['user_id' => 'user_id']);
    }
}
