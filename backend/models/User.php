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
 * @property string $password
 * @property string $token
 * @property string $email
 * @property integer $role
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
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
            [['username','password', 'created_at', 'updated_at'], 'required'],
            [['role', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['username'], 'string', 'max' => 50],
            [['auth_key', 'password', 'token', 'email'], 'string', 'max' => 32],
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
            'id' => '编号',
            'username' => '用户名',
            'auth_key' => '自动登录key',
            'password' => '密码',
            'userpassword' => '用户密码',
            'token' => 'Token',
            'email' => '邮箱',
            'role' => '角色',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => 'Updated At',
        ];
    }

    public static function findIdentity($id)
    {
        return static::find()->where(['id'=>$id])->one();
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['token' => $token]);
    }

    public static function findIdentityByUsername($username)
    {
        return static::findOne(['username'=>$username]);
    }

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

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

//    //查看用户的角色
//    public static function getUserRoleName($role){
//        $rolemodel=Dist::find()->where(['type'=>'后台用户'])->andWhere(['id'=>$role])->one();
//        if(!empty($rolemodel)){
//            return $rolemodel->name;
//        }else{
//            return '角色不存在';
//        }
//    }

}
