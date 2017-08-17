<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model backend\models\RepairOrder */

$this->title = '报表';
$this->params['breadcrumbs'][] = ['label' => 'Repair Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repair-order-view">
<!--    折线图-->
    <?=miloschuman\highcharts\Highcharts::widget([
        'options' => [
            'title' => ['text' => $month.' 的报表如下'],

            'xAxis' => [
                'categories' => $datetime
            ],
            'yAxis' => [
                'title' => ['text' => '金额']
            ],
            'series' => $money
        ]
    ]);?>


</div>
