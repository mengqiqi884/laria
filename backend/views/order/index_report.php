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

    <h1><? //= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <? //= Html::a('新增', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?=\kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'showPageSummary' => true,
        'pjax' => true,
        'striped' => false,
      //  'hover' => true,
        'export' => false,
        'panel' => ['type' => 'primary', 'heading' => ''],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'attribute' => 'order_code',
                'width' => '310px',
                'value' => function ($model, $key, $index, $widget) {
                    return $model->order_code;
                },
                'group' => true, // enable grouping,
//                'groupHeader'=>function ($model, $key, $index, $widget) { // Closure method
//                    return [
//                        'mergeColumns'=>[[1,3]], // columns to merge in summary
//                        'content'=>[ // content to show in each summary cell
//                            1=>'Summary (' . $model->hardware_price . ')',
//                            4=>\kartik\grid\GridView::F_AVG,
//                            5=>\kartik\grid\GridView::F_SUM,
//                            6=>\kartik\grid\GridView::F_SUM,
//                        ],
//                        'contentFormats'=>[ // content reformatting for each summary cell
//                            4=>['format'=>'number', 'decimals'=>2],
//                            5=>['format'=>'number', 'decimals'=>0],
//                            6=>['format'=>'number', 'decimals'=>2],
//                        ],
//                        'contentOptions'=>[ // content html attributes for each summary cell
//                            1=>['style'=>'font-variant:small-caps'],
//                            4=>['style'=>'text-align:right'],
//                            5=>['style'=>'text-align:right'],
//                            6=>['style'=>'text-align:right'],
//                        ],
//// html attributes for group summary row
//                        'options'=>['class'=>'danger','style'=>'font-weight:bold;']
//                    ];
//                },
              // 'groupedRow' => true, // move grouped column to a single grouped row
                'groupOddCssClass' => 'kv-grouped-row', // configure odd group cell css class
                'groupEvenCssClass' => 'kv-grouped-row', // configure even group cell css class
            ],
            [
                'attribute' => 'appliance_id',
                'width' => '250px',
                'value' => function ($model, $key, $index, $widget) {
                    return $model->appliance->name;
                },
//                'filterType' => GridView::FILTER_SELECT2,
//                'filter' => ArrayHelper::map(Categories::find()->orderBy('category_name')->asArray()->all(), 'id', 'category_name'),
//                'filterWidgetOptions' => [
//                    'pluginOptions' => ['allowClear' => true],
//                ],
             //   'filterInputOptions' => ['placeholder' => 'Any category'],
                'group' => true, // enable grouping
                'subGroupOf' => 1 // supplier column index is the parent group
            ],
//            [
//                'attribute' => 'brand_name',
//                'pageSummary' => 'Page Summary',
//                'pageSummaryOptions' => ['class' => 'text-right text-warning'],
//            ],
            [
                'attribute' => 'brand_name',
                'value' => function($model,$key,$index) {
                    return $model->brand_name;
                }
            ],
            [
                'attribute' => 'total_price',
                'width' => '150px',
                'hAlign' => 'right',
                'format' => ['decimal', 2],
                'pageSummary' => true,
                'pageSummaryFunc' => \kartik\grid\GridView::F_AVG
            ],
            [
                'attribute' => 'check_price',
                'width' => '150px',
                'hAlign' => 'right',
                'format' => ['decimal', 2],
                'pageSummary' => true
            ],
            [
                'class' => 'kartik\grid\FormulaColumn',
                'header' => 'Amount In Stock',
                'value' => function ($model, $key, $index, $widget) {
                    $p = compact('model', 'key', 'index');
                    return $widget->col(4, $p) * $widget->col(5, $p);
                },
                'mergeHeader' => true,
                'width' => '150px',
                'hAlign' => 'right',
                'format' => ['decimal', 2],
                'pageSummary' => true
            ],
        ],
    ]);

    ?>

</div>
