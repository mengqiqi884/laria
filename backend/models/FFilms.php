<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "f_films".
 *
 * @property string $id
 * @property string $name
 * @property string $pic
 * @property string $publisher
 * @property string $director
 * @property string $leaders
 * @property string $level
 * @property string $introduction
 * @property string $score
 * @property integer $views
 * @property integer $today_hot
 * @property string $release_time
 * @property integer $state
 * @property string $created_time
 * @property string $updated_time
 */
class FFilms extends \yii\db\ActiveRecord
{
    public $bus_pic;
    public $mode;
    public $video;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'f_films';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name','publisher', 'release_time'], 'required'],
            [['score'], 'number'],
            [['views', 'today_hot', 'state'], 'integer'],
            [['release_time', 'created_time', 'updated_time'], 'safe'],
            [['id'], 'string', 'max' => 50],
            [['name', 'pic', 'publisher', 'director'], 'string', 'max' => 200],
            [['leaders'], 'string', 'max' => 500],
            [['level'], 'string', 'max' => 20],
            [['introduction'], 'string', 'max' => 1000],

            [['bus_pic','mode'], 'string', 'max' => 50],
            [['video'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '电影名称',
            'pic' => '封面图',
            'publisher' => '出版社',
            'director' => '导演',
            'leaders' => '主要演员',
            'level' => '电影类型',
            'introduction' => '简介',
            'score' => '评分',
            'views' => '观看者',
            'today_hot' => '今日最热',
            'release_time' => '上映时间',
            'state' => '状态',
            'created_time' => '发布时间',
            'updated_time' => '编辑时间',
        ];
    }
}
