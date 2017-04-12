<?php
namespace frontend\models;

//use common\models\User;
use common\models\TbUser;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_confirm;

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

            [['password','password_confirm'], 'required'],
            ['password', 'string', 'min' => 6],
            [['password_confirm'], 'compare', 'compareAttribute' => 'password'],
        ];
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
                //print_r($user->getErrors());
            }
        }

        return null;
    }
}
