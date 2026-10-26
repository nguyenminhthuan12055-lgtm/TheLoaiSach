<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Form đăng nhập.
 */
class LoginForm extends Model
{
    public $username;
    public $password;

    private $_user = false;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Tên đăng nhập',
            'password' => 'Mật khẩu',
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Tên đăng nhập hoặc mật khẩu không chính xác!');
            }
        }
    }

    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser());
        }
        return false;
    }

    protected function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername(trim((string) $this->username));
        }
        return $this->_user;
    }
}
