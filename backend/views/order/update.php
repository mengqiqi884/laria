<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RepairOrder */

$this->title = 'Update Repair Order: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Repair Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="repair-order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
