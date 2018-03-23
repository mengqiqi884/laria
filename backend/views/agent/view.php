<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CAgent */

$this->title = $model->a_id;
$this->params['breadcrumbs'][] = ['label' => 'Cagents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cagent-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->a_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->a_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'a_id',
            'a_account',
            'a_pwd',
            'a_name',
            'a_areacode',
            'a_brand',
            'a_address',
            'a_concat',
            'a_phone',
            'a_email:email',
            'a_position',
            'a_state',
            'created_time',
            'updated_time',
            'is_del',
        ],
    ]) ?>

</div>
