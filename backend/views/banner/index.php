<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CBannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '广告图展示';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .thumbnails .actions i {
        margin-right: 5px;
    }

    .no-padding .btn {
        border: 2px solid #EBC012;
        background-color: #efefef;
        box-shadow: 1px 2px 2px #999;
        color: #EBC012;
        font-size: 12px;
        font-weight: bold;
        border-radius: 5px;
    }
</style>

<div id="content-header">
    <div id="breadcrumb">
        <a href="<?= Yii::$app->getHomeUrl() ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 主页</a>
        <a href="#" class="current">系统管理</a>
        <a href="<?= Url::toRoute('banner/index') ?>" class="current"><?= Html::encode($this->title) ?></a>
    </div>
</div>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-picture"></i></span>
                    <h5><?= Html::encode($this->title); ?></h5>
                </div>
                <div class="widget-content no-padding">
                    <a class="btn btn-mini" href="<?= Url::toRoute(['banner/create']) ?>"><i
                            class=" icon-plus-sign"></i>添加广告图</a>
                </div>
                <div class="widget-content">
                    <div class="row-fluid">
                        <div class="widget-content nopadding updates">
                            <?php
                            foreach ($dataProvider as $key => $data) {
                                ?>
                                <div class="new-update clearfix">
                                    <i class="icon-ok-sign"></i>
                                    <div class="update-done">
                                        <!--图片集-->
                                        <ul class="thumbnails">
                                            <?php
                                            foreach ($data as $img) {
                                                ?>
                                                <li class="span2">
                                                    <a class="thumbnail lightbox_trigger"
                                                       href="<?= '../../../' . $img['b_img'] ?>">
                                                        <img src="<?= '../../../' . $img['b_img'] ?>"
                                                             alt="<?= $img['b_title'] ?>">
                                                    </a>
                                                    <div class="actions">
                                                        <a title="编辑"
                                                           href="<?= Url::toRoute(['banner/update?id=' . $img['b_id']]) ?>">
                                                            <i class="icon-pencil icon-white"></i>
                                                        </a>
                                                        <a title="删除"
                                                           href="<?= Url::toRoute(['banner/delete?id=' . $img['b_id']]) ?>">
                                                            <i class="icon-remove icon-white"></i>
                                                        </a>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="update-date">
                                        <span
                                            class="update-day"><?= $key == 1 ? '首页' : ($key == 2 ? '用车报告' : ($key == 3 ? '维修保养' : '无')) ?></span>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
