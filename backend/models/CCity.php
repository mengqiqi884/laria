<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "c_city".
 *
 * @property string $id
 * @property string $name
 * @property string $code
 * @property integer $level
 * @property integer $status
 * @property string $parent
 * @property integer $is_hot
 * @property string $create_time
 */
class CCity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c_city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['level', 'status', 'is_hot'], 'integer'],
            [['create_time'], 'safe'],
            [['id'], 'string', 'max' => 150],
            [['name'], 'string', 'max' => 90],
            [['code', 'parent'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'code' => 'Code',
            'level' => 'Level',
            'status' => 'Status',
            'parent' => 'Parent',
            'is_hot' => 'Is Hot',
            'create_time' => 'Create Time',
        ];
    }

    /**
     * 根据城市编码获取城市名称
     */
    public static function getCityName($city_code){
        $query = self::find()->where(['code'=>$city_code,'status'=>1])->one();
        return !$query ? '城市不详':$query->name;
    }

    /**
     * 获取所有的城市列表
     */
    public static function getAllCityList(){
        $query = self::find()->where(['level'=>2, 'status'=>1])->asArray()->all();
        return !$query ? []:ArrayHelper::map($query,'code','name');
    }
}
