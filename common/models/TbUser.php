<?php

namespace common\models;

use Yii;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;
use backend\modules\user\models\TbUserProfile;
/**
 * This is the model class for table "tb_user".
 *
 * @property integer $user_id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $password_reset_token
 * @property string $auth_key
 * @property string $displayname
 * @property string $user_timecreate
 * @property string $timestamp
 * @property integer $user_status
 */
class TbUser extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_NOTACTIVE = 0;
    const STATUS_ACTIVE = 1;
    
    const ROLE_USER = 1;
    const ROLE_MANAGER = 5;
    const ROLE_ADMIN = 10;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['user_status' ,'default' ,'value' => self::STATUS_ACTIVE],
            ['user_status' ,'in' ,'range' => [
                self::STATUS_ACTIVE,self::STATUS_NOTACTIVE
            ]],
            
            
            [['username', 'password'], 'required'],
            [['user_timecreate'], 'safe'],
            [['timestamp', 'user_status'], 'integer'],
            [['username'], 'string', 'max' => 30],
            [['email'], 'string', 'max' => 255],
            [['password', 'displayname'], 'string', 'max' => 60],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique']
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
            'fullname' => 'ชื่อ-นามสกุล',
        ];
    }
    ########## Additional Method ##########
    
    
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'user_status' => self::STATUS_ACTIVE]);
    }
    
     public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
    
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }
    
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    
    
    
    public function getAuthKey() {
        return $this->auth_key;
    }

    public function getId() {
        return $this->getPrimaryKey();
    }

    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    public static function findIdentity($id) {
        return static::findOne(['user_id' => $id, 'user_status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
         throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
    
    #########################
    
     public function getProfile()
    {
        return $this->hasOne(TbUserProfile::className(), ['user_id' => 'user_id']);
    }
     public function getAuth()
    {
        return $this->hasOne(AuthAssignment::className(), ['user_id' => 'user_id']);
    }
    
    public function getFullname(){
        if(!empty($this->profile->user_name)||!empty($this->profile->user_surname)){
            return $this->profile->user_name.' '.$this->profile->user_surname;
        }else{
            return null; 
        }
    }
    //public $password_reset_token;
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }
    
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'user_status' => self::STATUS_ACTIVE,
        ]);
    }
    
    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    

}
