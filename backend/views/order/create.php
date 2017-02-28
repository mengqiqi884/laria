<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\RepairOrder */

$this->title = 'Create Repair Order';
$this->params['breadcrumbs'][] = ['label' => 'Repair Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repair-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
