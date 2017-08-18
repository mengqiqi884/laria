<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "c_user".
 *
 * @property string $u_id
 * @property integer $u_type
 * @property string $u_phone
 * @property string $u_pwd
 * @property string $u_headImg
 * @property string $u_nickname
 * @property string $u_sex
 * @property integer $u_age
 * @property integer $u_score
 * @property integer $u_cars
 * @property integer $u_forums
 * @property integer $u_state
 * @property string $u_token
 * @property string $u_register_id
 * @property integer $is_del
 * @property string $created_time
 * @property string $updated_time
 *
 * @property CForums[] $cForums
 * @property COrders[] $cOrders
 * @property CScoreLog[] $cScoreLogs
 */
class CUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['u_type', 'u_age', 'u_score', 'u_cars', 'u_forums', 'u_state', 'is_del'], 'integer'],
            [['u_pwd'], 'required'],
            [['created_time', 'updated_time'], 'safe'],
            [['u_phone', 'u_pwd', 'u_token', 'u_register_id'], 'string', 'max' => 32],
            [['u_headImg', 'u_nickname'], 'string', 'max' => 200],
            [['u_sex'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'u_id' => 'U ID',
            'u_type' => 'U Type',
            'u_phone' => '联系方式',
            'u_pwd' => 'U Pwd',
            'u_headImg' => '头像',
            'u_nickname' => '昵称',
            'u_sex' => '性别',
            'u_age' => '年龄',
            'u_score' => '积分',
            'u_cars' => '车辆数',
            'u_forums' => '帖子数',
            'u_state' => '状态',
            'u_token' => 'U Token',
            'u_register_id' => 'U Register ID',
            'is_del' => 'Is Del',
            'created_time' => '创建日期',
            'updated_time' => 'Updated Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCForums()
    {
        return $this->hasMany(CForums::className(), ['f_user_id' => 'u_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCOrders()
    {
        return $this->hasMany(COrders::className(), ['o_user_id' => 'u_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCScoreLogs()
    {
        return $this->hasMany(CScoreLog::className(), ['sl_user_id' => 'u_id']);
    }

    public static function getUserState($stats)
    {
        $str = '无';
        switch($stats){
            case 1: $str = '<span class="badge badge-success">启用</span>';break;
            case 2: $str = '<span class="badge badge-info">禁用</span>';break;
        }
        return $str;
    }
}
