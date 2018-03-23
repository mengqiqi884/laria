<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "auth_item".
 *
 * @property string $i_id
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $rule_name
 * @property string $data
 * @property integer $level
 * @property integer $p_level
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AuthAssignment[] $authAssignments
 * @property AdminRule $ruleName
 * @property AuthItemChild[] $authItemChildren
 * @property AuthItemChild[] $authItemChildren0
 */
class CRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['type', 'level', 'p_level', 'created_at', 'updated_at'], 'integer'],
            [['description', 'data'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64],

            [['name'], 'unique'], //添加场景
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'i_id' => 'I ID',
            'name' => '角色名称',
            'type' => 'Type',
            'description' => '描述',
            'rule_name' => '规则名称',
            'data' => 'Data',
            'level' => 'Level',
            'p_level' => 'P Level',
            'created_at' => '添加日期',
            'updated_at' => 'Updated At',
        ];
    }

    //场景说明
    public function validItem()
    {
        $query=self::find();
        if(!empty($this->name)){
            $query->where(['name'=>$this->name]);
        }
        if(!empty($this->i_id)){
            $query->andWhere(['<>','i_id',$this->i_id]);
        }
        $model=$query->one();
        if(!empty($model)){
            $this->addError('name','*此角色名已存在');
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::className(), ['item_name' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRuleName()
    {
        return $this->hasOne(AdminRule::className(), ['name' => 'rule_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItemChildren()
    {
        return $this->hasMany(AuthItemChild::className(), ['parent' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItemChildren0()
    {
        return $this->hasMany(AuthItemChild::className(), ['child' => 'name']);
    }
}
