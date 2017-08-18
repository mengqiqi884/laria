<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FFilms */

$this->title = '影片编辑: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '正在上映', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ffilms-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
