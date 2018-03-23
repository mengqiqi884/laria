<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CRole */

$this->title = 'Update Crole: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Croles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'i_id' => $model->i_id, 'name' => $model->name]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="crole-update">

    <?php
    switch($flag){
        case 'role':
            echo $this->render('_roleform', [
                'model' => $model,
                'title' => '编辑角色'
            ]);
            break;
    }
    ?>

</div>
