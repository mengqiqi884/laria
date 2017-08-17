<?php

use yii\helpers\Html;

use \backend\models\Dist;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RepairOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '订单管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repair-order-index">


    <?php

    use yii\web\JsExpression;

    //折线图
    echo miloschuman\highcharts\Highcharts::widget([
        'options' => [
            'title' => ['text' => '每人吃水果数量'],

            'xAxis' => [
                'categories' => ['苹果', '香蕉', '橙子','梨','葡萄']
            ],
            'yAxis' => [
                'title' => ['text' => '数量']
            ],
            'series' => [
                ['name' => '简', 'data' => [1, 0, 4 , 10 , 2]],
                ['name' => '杰', 'data' => [5, 7, 3 , 6 , 8]],
                ['name' => '贝克','data' =>[2, 3, 0 , 5 , 12]],
                ['name' => '球球','data' =>[15, 0, 0 , 2 , 8]]
            ]
        ]
    ]);

    //扇形图
    echo miloschuman\highcharts\Highcharts::widget([
        'options'=>[
             "chart"=>[
                 "plotBackgroundColor"=>null,
                 "plotBorderWidth"=>null,
                 "plotShadow"=>false,
             ],
             "title"=>[
                 "text"=>"2010年web浏览器使用频率"
             ],
             "tooltip"=>[
                 "pointFormat"=>"{series.name}: <b>{point.percentage:.1f}%</b>"
             ],
             "plotOptions"=>[
                 "pie"=>[
                     "allowPointSelect"=> true,
                     "cursor"=> "pointer",
                     "dataLabels"=>[
                         "enabled"=>true,
                         "color"=>"#000000",
                         "connectorColor"=>"#000000",
                         "format"=>"<b>{point.name}</b>: {point.percentage:.1f} %"
                     ]
                 ]
             ],
             "series"=>[
                [
                    "type"=> "pie",
                    "name"=> "Browser share",
                    "data"=> [
                         ["火狐",   45.0],
                         ["ie",       26.8],
//                         ["谷歌",12.8],
                         [   //表示当前被选中的区域
                             "name"=>"谷歌",
                             "y"=> 12.8,
                             "sliced"=> true,
                             "selected"=> true
                        ],
                        ["Safari",    8.5],
                        ["欧朋",     6.2],
                        ["其他",   0.7]
                    ]
                ]
             ]
        ]
    ]);
?>
</div>
