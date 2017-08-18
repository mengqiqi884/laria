<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FRechargeOrder */

$this->title = 'Update Frecharge Order: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Frecharge Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="frecharge-order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
