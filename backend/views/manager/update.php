<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CAdmin */

$this->title = 'Update Cadmin: ' . ' ' . $model->a_id;
$this->params['breadcrumbs'][] = ['label' => 'Cadmins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->a_id, 'url' => ['view', 'id' => $model->a_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cadmin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
