<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CBanner */

$this->title = 'Update Cbanner: ' . ' ' . $model->b_id;
$this->params['breadcrumbs'][] = ['label' => 'Cbanners', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->b_id, 'url' => ['view', 'id' => $model->b_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cbanner-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
