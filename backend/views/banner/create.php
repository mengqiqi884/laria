<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CBanner */

$this->title = '添加广告图';
$this->params['breadcrumbs'][] = ['label' => 'Cbanners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cbanner-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
