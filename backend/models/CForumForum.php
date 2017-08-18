<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "c_forum_forum".
 *
 * @property string $ff_id
 * @property string $ff_name
 * @property string $ff_logo
 * @property integer $is_del
 *
 * @property CForums[] $cForums
 */
class CForumForum extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c_forum_forum';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ff_name', 'ff_logo'], 'required'],
            [['is_del'], 'integer'],
            [['ff_name'], 'string', 'max' => 100],
            [['ff_logo'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ff_id' => 'Ff ID',
            'ff_name' => 'Ff Name',
            'ff_logo' => 'Ff Logo',
            'is_del' => 'Is Del',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCForums()
    {
        return $this->hasMany(CForums::className(), ['f_fup' => 'ff_id']);
    }

    /**
     * 将栏目组合成key-value形式
     */
    public static  function  get_type(){
        $fup = self::find()->all();
        $fup = ArrayHelper::map($fup, 'ff_id', 'ff_name');
        return $fup;
    }
}
