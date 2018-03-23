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
    public $pic;
    public $province;
    public $city;
    public $area;
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

            ['a_email','email','message'=>'邮箱格式不正确'],

            ['a_name','unique'],//唯一
            ['a_logo','file','extensions'=>['png','jpg','gif'],'maxSize'=>1024*1024*1024],

            [['a_phone'], 'validItem'], //添加场景
            [['a_phone'],'match','pattern'=>'/^[1][358][0-9]{9}$/','message' =>'手机号格式不正确']
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

    //场景说明
    public function validItem()
    {
        $query=self::find();
        if(!empty($this->a_phone)){
            $query->where(['a_phone'=>$this->a_phone]);
        }
        if(!empty($this->a_id)){
            $query->andWhere(['<>','a_id',$this->a_id]);
        }
        $model=$query->one();
        if(!empty($model)){
            $this->addError('a_phone','*该手机号已存在');
        }
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
    public static function getAdminRoleName($roleid){
        $sql = '';
        $sql .= 'select name from auth_item where i_id='.$roleid;
        $query = Yii::$app->db->createCommand($sql)->queryOne();
        return $query ? $query['name'] : '角色未定义';
    }

    //获取角色列表
    public static function getAllRoleName(){
        $sql = '';
        $sql .= 'select i_id,name from auth_item where type=1';
        $query = Yii::$app->db->createCommand($sql)->queryAll();

        $data = [];
        foreach($query as $item){
            $data[$item['i_id']] = $item['name'];
        }

        return $data;
    }

    //管理员当前状态
    public static function getAdminState($stats)
    {
        $str = '无';
        switch($stats){
            case 1: $str = '<span class="badge badge-success">启用</span>';break;
            case 2: $str = '<span class="badge badge-info">禁用</span>';break;
        }
        return $str;
    }
//    public static function getUserRoleName($role){
//        $rolemodel=Dist::find()->where(['type'=>'后台用户'])->andWhere(['id'=>$role])->one();
//        if(!empty($rolemodel)){
//            return $rolemodel->a_name;
//        }else{
//            return '角色不存在';
//        }
//    }

}
