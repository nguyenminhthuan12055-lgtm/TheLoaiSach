<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Model User - bảng `users`.
 *
 * @property string $username Tên đăng nhập (khóa chính)
 * @property string $password Mật khẩu đã băm (password_hash)
 * @property string $role     Vai trò: admin | user
 */
class User extends ActiveRecord implements IdentityInterface
{
    public const ROLE_ADMIN = 'admin';
    public const ROLE_USER = 'user';

    public static function tableName()
    {
        return 'users';
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function getRoleLabel()
    {
        return $this->isAdmin() ? 'Quản trị viên' : 'Người dùng';
    }

    // ----- IdentityInterface -----

    public static function findIdentity($id)
    {
        return static::findOne(['username' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function getId()
    {
        return $this->username;
    }

    // Không dùng đăng nhập ghi nhớ (enableAutoLogin = false) nên 2 hàm dưới không được gọi.
    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return false;
    }
}
