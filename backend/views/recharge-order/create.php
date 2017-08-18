<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\FRechargeOrder */

$this->title = 'Create Frecharge Order';
$this->params['breadcrumbs'][] = ['label' => 'Frecharge Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frecharge-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
