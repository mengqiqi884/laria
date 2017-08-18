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
class Admin extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $userpassword;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c_admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['a_name','a_pwd'], 'required'],
            [['a_state','is_del'], 'integer'],
            [['created_time', 'updated_time','last_login_time',], 'safe'],
            [['a_phone'], 'string', 'max' => 11],
            [['a_logo','a_role'], 'string', 'max' => 200],
            [['a_pwd', 'a_token'], 'string', 'max' => 32],
            [['a_name','a_realname','a_position','a_email','a_type'], 'string', 'max' => 100],
            //['a_pwd','match','pattern'=>'/^[\w\W]{5,16}$/','message'=>'密码长度为5~16位'],
            ['a_email','match','pattern'=>'/^(\w)+(\.\w+)*@(\w)+((\.\w+)+)$/','message'=>'邮箱格式不正确'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'a_id' => '编号',
            'a_logo' => '头像',
            'a_name' => '用户名',
            'a_pwd' => '密码',
            'userpassword' => '用户密码',
            'a_realname' => '姓名',
            'a_token' => 'token',
            'a_position' => '职位',
            'a_phone' => '联系方式',
            'a_email' => '邮箱',
            'a_type' => '类型',
            'a_role' => '角色',
            'a_state' => '状态',
            'last_login_time' => '最近一次登录时间',
            'created_time' => '创建时间',
            'updated_time' => 'Updated At',
            'is_del' => '是否删除',
        ];
    }

    public static function findIdentity($id)
    {
        return static::find()->where(['a_id'=>$id])->one();
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['a_token' => $token]);
    }

    public static function findIdentityByUsername($username)
    {
        return static::findOne(['a_name'=>$username]);
    }

    public function getId()
    {
        return $this->a_id;
    }

    /**
     * @return mixed
     */
    public function getAuthKey()
    {
        return $this->a_token;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    //查看用户的角色
//    public static function getUserRoleName($role){
//        $rolemodel=Dist::find()->where(['type'=>'后台用户'])->andWhere(['id'=>$role])->one();
//        if(!empty($rolemodel)){
//            return $rolemodel->a_name;
//        }else{
//            return '角色不存在';
//        }
//    }

}
