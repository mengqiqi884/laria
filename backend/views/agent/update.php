<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CAgent */

$this->title = '编辑4s店： `' . $model->a_name . '` 信息'  ;
$this->params['breadcrumbs'][] = ['label' => 'Cagents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->a_id, 'url' => ['view', 'id' => $model->a_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cagent-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
