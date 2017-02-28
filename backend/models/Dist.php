<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "dist".
 *
 * @property string $type
 * @property string $name
 * @property integer $id
 */
class Dist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'id'], 'required'],
            [['id'], 'integer'],
            [['type', 'name'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'type' => 'Type',
            'name' => 'Name',
            'id' => 'ID',
        ];
    }

    /*根据id查找名称*/
    public static function getTypeName($id,$type){
        $rolemodel=Dist::find()->where(['type'=>$type])->andWhere(['id'=>$id])->one();
        if(!empty($rolemodel)){
            return $rolemodel->name;
        }else{
            return '不存在';
        }
    }

    /*获取该分类下所有对象*/
    public static function getAllName($type){
        $rolemodel=Dist::find()->where(['type'=>$type])->asArray()->all();
        $query=array();
        foreach($rolemodel as $k=>$v){
            $query[$v['id']]=$v['name'];
        }
        return $query;
    }
}
