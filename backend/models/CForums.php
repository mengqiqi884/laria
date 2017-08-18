<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "c_forums".
 *
 * @property string $f_id
 * @property string $f_fup
 * @property string $f_user_id
 * @property string $f_user_nickname
 * @property string $f_pic
 * @property string $f_title
 * @property string $f_content
 * @property integer $f_views
 * @property integer $f_replies
 * @property integer $f_is_top
 * @property integer $f_is_first_top
 * @property integer $f_state
 * @property string $f_car_cycle
 * @property string $f_car_miles
 * @property string $f_car_describle
 * @property string $created_time
 * @property string $updated_time
 * @property integer $is_del
 *
 * @property CForumReplies[] $cForumReplies
 * @property CUser $fUser
 * @property CForumForum $fFup
 */
class CForums extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c_forums';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['f_fup', 'f_user_nickname', 'f_title'], 'required'],
            [['f_fup', 'f_user_id', 'f_views', 'f_replies', 'f_is_top', 'f_is_first_top', 'f_state', 'is_del'], 'integer'],
            [['f_content'], 'string'],
            [['created_time', 'updated_time'], 'safe'],
            [['f_user_nickname'], 'string', 'max' => 150],
            [['f_pic', 'f_title', 'f_car_describle'], 'string', 'max' => 200],
            [['f_car_cycle', 'f_car_miles'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'f_id' => '帖子编号',
            'f_fup' => '贴子主题',
            'f_user_id' => 'F User ID',
            'f_user_nickname' => '发帖人',
            'f_pic' => '封面图',
            'f_title' => '标题',
            'f_content' => '内容',
            'f_views' => '浏览量',
            'f_replies' => '回复数',
            'f_is_top' => '是否置顶',
            'f_is_first_top' => 'F Is First Top',
            'f_state' => '状态',
            'f_car_cycle' => '用车周期',
            'f_car_miles' => '行车里程',
            'f_car_describle' => '用车描述',
            'created_time' => '发布时间',
            'updated_time' => 'Updated Time',
            'is_del' => '是否删除',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCForumReplies()
    {
        return $this->hasMany(CForumReplies::className(), ['fr_forum_id' => 'f_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFUser()
    {
        return $this->hasOne(CUser::className(), ['u_id' => 'f_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFFup()
    {
        return $this->hasOne(CForumForum::className(), ['ff_id' => 'f_fup']);
    }

    /*获取帖子主题*/
    public static function getForumTopicName($fup){
        $name = CForumForum::find()->select('ff_name')->where(['ff_id'=>$fup])->asArray()->one();
        return $name;
    }

    public static function getState($stats)
    {
        $str = '无';
        switch($stats){
            case 1: $str = '<span class="icon-ok-circle"></span>正常';break;
            case -1: $str = '<span class=" icon-ban-circle"></span>禁用';break;
        }
        return $str;
    }
}
