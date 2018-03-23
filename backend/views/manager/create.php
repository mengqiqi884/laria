<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CAdmin */

$this->title = '新增管理员';
$this->params['breadcrumbs'][] = ['label' => 'Cadmins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cadmin-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
