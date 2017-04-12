<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "tb_user".
 *
 * @property integer $user_id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $auth_key
 * @property string $displayname
 * @property string $user_timecreate
 * @property string $timestamp
 * @property integer $user_status
 *
 * @property TbUserProfilePsu $tbUserProfilePsu
 */
class TbUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_user';
    }
    public $password_confirm;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username','email'], 'required'],
            [['user_timecreate'], 'safe'],
            [['timestamp', 'user_status'], 'integer'],
            [['username'], 'string', 'max' => 30],
            [['email'], 'string', 'max' => 255],
            [['displayname'], 'string', 'max' => 60],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            //[['password'],'compare'],
            [['password_confirm'],'safe'],
            [['password', 'password_confirm'], 'required'],
            //[['password', 'password_confirm'], 'string', 'min'=>6,'max' => 40],
            
            [['password_confirm'], 'compare', 'compareAttribute' => 'password'],
        ];
    }
    

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'displayname' => 'Displayname',
            'user_timecreate' => 'User Timecreate',
            'timestamp' => 'Timestamp',
            'user_status' => 'สถานะเช่น รักษาการ',
            'password_confirm' => 'ยืนยันรหัสผ่าน',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbUserProfilePsu()
    {
        return $this->hasOne(TbUserProfilePsu::className(), ['user_id' => 'user_id']);
    }
    
     #########################
    
     public function getProfile()
    {
        return $this->hasOne(TbUserProfile::className(), ['user_id' => 'user_id']);
    }
    
    public function getFullname(){
        if(!empty($this->profile->user_name)||!empty($this->profile->user_surname)){
            return $this->profile->user_name.' '.$this->profile->user_surname;
        }else{
            return null; 
        }
    }
    ##################################
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
        $this->password_confirm = $this->password;
    }
    
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    
    
    
}
