<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CAgent */

$this->title = '新增4S店';
$this->params['breadcrumbs'][] = ['label' => 'Cagents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cagent-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
