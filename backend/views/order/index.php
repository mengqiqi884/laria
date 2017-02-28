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

    <h1><?//= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=\kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'order_code',
            [
                'attribute' => 'user_name',
                'value' => 'user.username'
            ],

            [
                'attribute' => 'name',
                'value' => 'appliance.name'
            ],
            [
                'attribute' => 'brand_name',
                'value' => 'brand.brand_name'
            ],
            [
                'attribute' => 'send_type',
                'value' => function($model){
                    return Dist::getTypeName($model->send_type,'维修类别');
                }
            ],
            [
                'attribute' => 'mer_name',
                'value' => 'mer_merchant.mer_name'
            ],
            [
                'attribute' => 'master_id',
                'value' => function($model){
                    return empty($model->master_id)?'':Dist::getTypeName($model->send_type,'维修类别');
                }
            ],

            [
                'attribute' =>  'is_offer',
                'format' => 'html',
                'value' => function($model){
                    return $model->is_offer ? '<span style="color: green">是</span>':'<span style="color: red">否</span>';
                }
            ],
            [
                'attribute' => 'service_type',
                'value' => function($model){
                    return Dist::getTypeName($model->service_type,'服务方式');
                }
            ],
             'repair_time',
             'total_price',
             'nums',
            [
                'attribute' => 'is_paid',
                'format' => 'html',
                'value' => function($model){
                    return $model->is_paid ? '<span style="color: green">是</span>':'<span style="color: red">否</span>';
                }
            ],
            [
                'attribute' => 'is_refund',
                'format' => 'html',
                'value' => function($model){
                    return $model->is_refund ? '<span style="color: green">是</span>':'<span style="color: red">否</span>';
                }
            ],
            [
                'attribute' => 'order_type',
                'value' => function($model){
                    return Dist::getTypeName($model->order_type,'订单类型');
                }
            ],
            [
                'attribute' => 'order_step',
                'value' => function($model){
                    return Dist::getTypeName($model->order_step,'订单完成状态');
                }
            ],
            [
                'attribute' => 'order_status',
                'value' => function($model){
                    return Dist::getTypeName($model->order_status,'订单支付状态');
                }
            ],
             'created_at',
            [
                'attribute' => 'is_del',
                'format' => 'html',
                'value' => function($model){
                    return $model->is_del ?'<span style="color: green">是</span>':'<span style="color: red">否</span>';
                }
            ],

            [
                'header' => '操作',
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
    ]); ?>

</div>
