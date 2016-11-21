<?php

namespace backend\models;

use Yii;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $userpassword;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['role', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            ['userpassword','match','pattern'=>'/^[\w\W]{5,16}$/','message'=>'密码长度为5~16位'],
            ['email','match','pattern'=>'/^(\w)+(\.\w+)*@(\w)+((\.\w+)+)$/','message'=>'邮箱格式不正确'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'auth_key' => '登陆时的key',
            'password_hash' => '加密密码',
            'userpassword'=>'密码',
            'password_reset_token' => '密码重置Token',
            'email' => '邮箱',
            'role' => '等级',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    /**
     * @param int|string $id
     * @return mixed
     */
    public static function findIdentity($id)
    {
        return static::find()->where(['id'=>$id])->one();
    }

    /**
     * @param mixed $token
     * @param mixed|null|null $type
     * @return mixed
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token]);
    }

    public static function findIdentityByUsername($username)
    {
        return static::findOne(['username'=>$username]);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return mixed
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
}
