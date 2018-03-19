<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "c_car".
 *
 * @property string $c_code
 * @property string $c_title
 * @property string $c_parent
 * @property string $c_logo
 * @property integer $c_level
 * @property integer $c_type
 * @property integer $c_price
 * @property integer $c_sortorder
 * @property string $c_imgoutside
 * @property string $c_imginside
 * @property string $c_volume
 * @property string $c_engine
 */
class CCar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c_car';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_code'], 'required'],
            [['c_level', 'c_type', 'c_price', 'c_sortorder'], 'integer'],
            [['c_code', 'c_parent'], 'string', 'max' => 60],
            [['c_title'], 'string', 'max' => 765],
            [['c_logo'], 'string', 'max' => 150],
            [['c_imgoutside', 'c_imginside'], 'string', 'max' => 1000],
            [['c_volume'], 'string', 'max' => 200],
            [['c_engine'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c_code' => 'C Code',
            'c_title' => 'C Title',
            'c_parent' => 'C Parent',
            'c_logo' => 'C Logo',
            'c_level' => 'C Level',
            'c_type' => 'C Type',
            'c_price' => 'C Price',
            'c_sortorder' => 'C Sortorder',
            'c_imgoutside' => 'C Imgoutside',
            'c_imginside' => 'C Imginside',
            'c_volume' => 'C Volume',
            'c_engine' => 'C Engine',
        ];
    }

    /**
     * 根据品牌编号获取品牌名称
     */
    public static function getBrandName($brand_code){
        $query = self::find()->where(['c_code'=>$brand_code,'c_type'=>1,'c_level'=>1])->one();
        return !$query ? '品牌不详':$query->c_title;
    }

    /**
     * 获取所有的品牌列表
     */
    public static function getAllBrandList(){
        $query = self::find()->where(['c_parent'=>0, 'c_level'=>1,'c_type'=>1])->asArray()->all();
        return !$query ? []:ArrayHelper::map($query,'c_code','c_title');
    }
}
