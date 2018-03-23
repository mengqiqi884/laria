<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CRole */

$this->title = 'Create Crole';
$this->params['breadcrumbs'][] = ['label' => 'Croles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="crole-create">

    <?php
    switch($flag){
        case 'role':
            echo $this->render('_roleform', [
                'model' => $model,
                'title' => '新增角色'
            ]);
            break;

        case 'operator':
            echo $this->render('_operatorform', [
                'model' => $model,
                'title' => '新增运营人员'
            ]);
            break;
    }
    ?>



</div>
