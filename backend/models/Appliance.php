<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "appliance".
 *
 * @property string $appliance_id
 * @property string $fid
 * @property string $name
 * @property string $logo
 * @property string $mclient_small_logo
 * @property string $uclient_logo
 * @property string $uclient_small_logo
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $is_del
 */
class Appliance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'appliance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'is_del'], 'integer'],
            [['fid', 'name'], 'string', 'max' => 30],
            [['logo', 'mclient_small_logo', 'uclient_logo', 'uclient_small_logo'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'appliance_id' => 'Appliance ID',
            'fid' => 'Fid',
            'name' => 'Name',
            'logo' => 'Logo',
            'mclient_small_logo' => 'Mclient Small Logo',
            'uclient_logo' => 'Uclient Logo',
            'uclient_small_logo' => 'Uclient Small Logo',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'is_del' => 'Is Del',
        ];
    }


}
