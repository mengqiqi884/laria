<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\FFilms */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '正在上映', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<style>
    .ffilms-view table{width: 48%}
</style>
<link href='<?=Url::to('@web/css/demo1.css')?>' rel="stylesheet" type="text/css" />
<script src="<?=Url::to('@web/js/jquery.js')?>" type="text/javascript"></script>
<script src='<?=Url::to('@web/js/jquery.easing.js')?>'></script>
<script src='<?=Url::to('@web/js/scroller.js')?>'></script>
<!--<script src='--><?//=Url::to('@web/js/init.js')?><!--'></script>-->

<div class="ffilms-view" style="position: relative">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'label' =>  '封面图',
                'format' => 'raw',
                'value' => '<img src="http://localhost/'.Yii::$app->params['base_file'].$model->pic.'" width="150px" height="150px">'
            ],

            'publisher',
            'director',
            'leaders',
            [
                'label' => '电影类型',
                'format' => 'raw',
                'value' => '<label class="label label-success">'.$model->level.'</label>'
            ],
            [
                'label' =>  '简介',
                'format' => 'raw',
                'value' => empty($model->introduction)?'<i class="text-danger">暂无介绍</i>':$model->introduction
            ],

            'score',
            'views',
            [
                'label' =>  '今日最热',
                'format' => 'raw',
                'value' => $model->today_hot ==0?'<i class="text-danger">否</i>':'<i class="fa fa-square-o text-success"></i>'
            ],

            'release_time',
            [
                'label' =>  '当前状态',
                'format' => 'raw',
                'value' => $model->state ==0?'<i class="btn btn-danger btn-xs">已下架</i>':'<i class="btn btn-default btn-xs">上架中</i>'
            ],

            'created_time',
        ],
    ]) ?>

    <table class="table table-striped table-bordered detail-view" style="float: right;position:absolute; top:0;right:2%;">
        <tbody>
            <tr>
                <th style="width:8%">剧照：</th>
                <td>
                    <div class="scroller demo1">
                        <div class="inside">
                            <a href="#"><img src="<?=Url::to('@web/img/img1.jpg')?>" alt="" /></a>
                            <a href="#"><img src="<?=Url::to('@web/img/img2.jpg')?>" alt="" /></a>
                            <a href="#"><img src="<?=Url::to('@web/img/img3.jpg')?>" alt="" /></a>
                            <a href="#"><img src="<?=Url::to('@web/img/img4.jpg')?>" alt="" /></a>
                            <a href="#"><img src="<?=Url::to('@web/img/img5.jpg')?>" alt="" /></a>
                            <a href="#"><img src="<?=Url::to('@web/img/img6.jpg')?>" alt="" /></a>
                            <a href="#"><img src="<?=Url::to('@web/img/img7.jpg')?>" alt="" /></a>
                            <a href="#"><img src="<?=Url::to('@web/img/rotate_center.png')?>" alt="" /></a>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div style="margin: 0 auto;text-align: center; ">
    <?=Html::a('<i class="fa fa-mail-reply"></i>',[$mode=='on' ? 'film-on-index': ($mode =='off' ? 'film-off-index': 'film-soon-index')],['title'=>'返回','class'=>'btn btn-primary'])?>
</div>
<script>
    $('.demo1').scroller();
</script>
