<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CCar */

$this->title = 'Update Ccar: ' . ' ' . $model->c_code;
$this->params['breadcrumbs'][] = ['label' => 'Ccars', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->c_code, 'url' => ['view', 'id' => $model->c_code]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ccar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
