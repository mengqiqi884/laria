<?php

namespace frontend\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "f_user".
 *
 * @property string $id
 * @property string $account
 * @property string $password
 * @property string $headImg
 * @property string $nickname
 * @property integer $score
 * @property integer $sex
 * @property integer $continue_login_times
 * @property string $last_login_time
 * @property string $created_time
 * @property string $updated_time
 * @property string $birthday
 */
class FUser extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $auth_key;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'f_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'account', 'password', 'last_login_time'], 'required'],
            [['score','sex', 'continue_login_times'], 'integer'],
            [['last_login_time', 'created_time', 'updated_time','birthday'], 'safe'],
            [['account'], 'string', 'max' => 30],
            [['password'], 'string', 'max' => 32],
            [['headImg','id','nickname','auth_key'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account' => 'Account',
            'password' => 'Password',
            'headImg' => 'Head Img',
            'nickname' => 'Nickname',
            'score' => 'Score',
            'continue_login_times' => 'Continue Login Times',
            'last_login_time' => 'Last Login Time',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
        ];
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['token' => $token]);
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['nickname' => $username]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

}
