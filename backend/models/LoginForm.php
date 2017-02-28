<?php
/**
 * Created by PhpStorm.
 * User: BF
 * Date: 2016/11/21
 * Time: 13:21
 */

namespace backend\models;
use yii\base\Exception;
use yii\base\Model;
use Yii;
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;

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
    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'password' => '密码',
            'rememberMe' => '记住密码'
        ];
    }

    public function checkStatus($status){
        if(!$this->hasErrors()){
            if($status != 1){
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }
    }

    public function checkRole($role){
        if(!$this->hasErrors()){
            if($role != 10){
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }
    }

    public function validatePassword()
    {
        $user = $this->getUser();
        if(!$user){
            $this->addError('username','用户不存在');
        }elseif (!$this->checkPassword($user->password)) {
            $this->addError('password', '密码错误');
        }elseif (!$this->checkStatus($user->status)) {
            $this->addError('username', '该账号状态异常,请联系管理员');
        }elseif (!$this->checkRole($user->role)) {
            $this->addError('username', '该用户非后台管理员');
        }
//        }elseif ($user->wa_lock!=0) {
//            $this->addError('wa_username', '该用户已被锁定');
//        }
    }

    public function checkPassword($password){
        if(!$this->hasErrors()){
            return $password == md5(Yii::$app->params['pwd_pre'].$this->password);
        }else{
            return false;
        }
    }

    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }


    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findIdentityByUsername($this->username);
        }

        return $this->_user;
    }

    public function UpdateModel(){
        $transaction = Yii::$app->db->beginTransaction();
        try{
            $user =$this->getUser();

            $user->auth_key=Yii::$app->security->generateRandomString(); //自动登陆key
            $user->token = Yii::$app->security->generateRandomString();
//            $user->created_at = date('Y-m-d H:i:s',time());
//            $user->updated_at = date('Y-m-d H:i:s',time());
            $r=$user->save();

            $transaction->commit();//提交
            if(!$r){
                return false;
            }else{
                return true;
            }
        }catch(Exception $e){
            $transaction->rollBack();
        }
    }
}