<?php
/**
 * Created by PhpStorm.
 * User: BF
 * Date: 2016/11/21
 * Time: 13:21
 */

namespace frontend\models;
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
            'username' => '帐号',
            'password' => '密码',
            'rememberMe' => '记住密码'
        ];
    }

    public function validatePassword()
    {
        $user = $this->getUser();
        if(!$user){
            $this->addError('username','用户不存在');
        }elseif (!$this->checkPassword($user->password)) {
            $this->addError('password', '密码错误');
        }
    }

    public function checkPassword($password){
        if(!$this->hasErrors()){
            return $password == md5($this->password);
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
            $this->_user = FUser::findByUsername($this->username);
        }

        return $this->_user;
    }

    public function UpdateModel(){
        $transaction = Yii::$app->db->beginTransaction();
        try{
            $user =$this->getUser();
            $last_time = $user->last_login_time;
            $continue_times = date('Y-m-d',strtotime($last_time)) == date('Y-m-d') ? ($user->continue_login_times +1): 1;


            $user->attributes =[
                'created_time' => date('Y-m-d H:i:s'),
                'updated_time' => date('Y-m-d H:i:s'),
                'last_login_time' => date('Y-m-d H:i:s'),
                'continue_login_times' => $continue_times,
            ];

            $r = $user->save();
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