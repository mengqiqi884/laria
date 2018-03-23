<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "c_agent".
 *
 * @property string $a_id
 * @property string $a_account
 * @property string $a_pwd
 * @property string $a_name
 * @property string $a_areacode
 * @property string $a_brand
 * @property string $a_address
 * @property string $a_concat
 * @property string $a_phone
 * @property string $a_email
 * @property string $a_position
 * @property integer $a_state
 * @property string $created_time
 * @property string $updated_time
 * @property integer $is_del
 *
 * @property COrders[] $cOrders
 */
class CAgent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c_agent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['a_account', 'a_pwd', 'a_name', 'a_areacode', 'a_brand'], 'required'],
            [['a_state', 'is_del'], 'integer'],
            [['created_time', 'updated_time'], 'safe'],
            [['a_account', 'a_pwd'], 'string', 'max' => 32],
            [['a_name'], 'string', 'max' => 50],
            [['a_areacode', 'a_address', 'a_position'], 'string', 'max' => 200],
            [['a_brand', 'a_concat', 'a_email'], 'string', 'max' => 100],
            [['a_phone'], 'string', 'max' => 11],

            ['a_email','email','message'=>'邮箱格式不正确'],
            [['a_phone'],'match','pattern'=>'/^[1][358][0-9]{9}$/','message' =>'手机号格式不正确']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'a_id' => 'A ID',
            'a_account' => '登录名',
            'a_pwd' => '登陆密码',
            'a_name' => '名称',
            'a_areacode' => '城市代码',
            'a_brand' => '品牌',
            'a_address' => '地址',
            'a_concat' => '联系人',
            'a_phone' => '联系人电话',
            'a_email' => '联系人邮箱',
            'a_position' => '联系人职位',
            'a_state' => '状态',
            'created_time' => '创建日期',
            'updated_time' => '更新日期',
            'is_del' => '是否删除 1是 0否',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCOrders()
    {
        return $this->hasMany(COrders::className(), ['o_agency_id' => 'a_id']);
    }

    /**
     * 获取4s店下已有城市列表
     */
    public static function getHaveCityList(){
        $query = self::find()
            ->select(['c_agent.a_areacode','c_city.name'])
            ->leftJoin('c_city', 'c_city.code = c_agent.a_areacode')
            ->where(['c_city.status'=>1,'c_agent.is_del'=>0])
            ->asArray()->all();

        return ArrayHelper::map($query,'a_areacode','name');
    }

    /**
     * 获取4s店下已有品牌列表
     */
    public static function getHaveBrandList(){
        $query = self::find()
            ->select(['c_agent.a_brand','c_car.c_title'])
            ->leftJoin('c_car', 'c_car.c_code = c_agent.a_brand')
            ->where(['c_car.c_type'=>1,'c_agent.is_del'=>0])
            ->asArray()->all();

        return ArrayHelper::map($query,'a_brand','c_title');
    }
}
