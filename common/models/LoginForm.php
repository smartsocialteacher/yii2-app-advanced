<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            //print_r($user);
            if (!$user||!$user->validatePassword($this->password)) {   
               $this->addError($attribute, 'Incorrect username or password.');
            }
        } 
    }
    

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = TbUser::findByUsername($this->username);
        }

        return $this->_user;
    }
}


/*
 * Array
(
    [status] => 1
    [info] => Array
        (
            [cn] => 0026668-ahamad
            [dn] => CN=0026668-ahamad,OU=D174,OU=F21,OU=C02,OU=Staffs,DC=psu,DC=ac,DC=th
            [accountname] => ahamad.j
            [personid] => 0026668
            [citizenid] => 1949900097921
            [campus] => วิทยาเขตปัตตานี
            [campusid] => 02
            [department] => สถาบันวัฒนธรรมศึกษากัลยาณิวัฒนา
            [departmentid] => 174
            [workdetail] => สถาบันวัฒนธรรมศึกษากัลยาณิวัฒนา
            [positionid] => 956
            [description] => อาฮาหมัด เจ๊ะดือราแม
            [displayname] => AHAMAD JEHDEURAMEA
            [detail] => พนักงานบริหารทั่วไป
            [title] => นาย
            [titleid] => 01
            [firstname] => AHAMAD
            [lastname] => JEHDEURAMEA
            [sex] => M
            [mail] => ahamad.j@psu.ac.th
            [othermail] => ahamad.j@psu.ac.th
        )

)
 * */
 
