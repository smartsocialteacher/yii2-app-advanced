<?php
namespace backend\modules\user\models;

//use common\models\User;
use Yii;
use app\modules\user\models\TbUser;
use yii\base\Model;


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Accout
 *
 * @author Madone
 */
class Accout extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_comfirm;
    public $_user;
    public $module;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\TbUser', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\TbUser', 'message' => 'This email address has already been taken.'],

            //['password', 'required'],
            ['password', 'string', 'min' => 6],
            [['password', 'password_confirm'], 'required'],
            //[['password', 'password_confirm'], 'string', 'min'=>6,'max' => 40],
            
            [['password_confirm'], 'compare', 'compareAttribute' => 'password'],
        ];
    }
     
    
    
   
    /** @inheritdoc */
    public function __construct($config = [])
    {       
        $this->module = Yii::$app->getModule('user');
//        echo "<pre>";
//        print_r($this->module);
//        echo "</pre>";
        $this->setAttributes([
            'username' => $this->user->username,
            //'email'    => $this->user->unconfirmed_email ?: $this->user->email,
            //'p'
        ], false);
        parent::__construct($config);
    }
    
    /** @return User */
    public function getUser()
    {
        if ($this->_user == null) {
            $this->_user = Yii::$app->user->identity;
        }
        return $this->_user;
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    { 
        if ($this->validate()) {
            $user = new TbUser();
            $user->username = $this->username;
            $user->email = $this->email;
            
            $user->user_timecreate=date("Y-m-d H:i:s");
            $user->setPassword($this->password);
            $user->generateAuthKey();
            
            if ($user->save()) {
                return $user;
            }else{
                print_r($user->getErrors());
            }
        }        
    }
}

