<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CCar */

$this->title = 'Create Ccar';
$this->params['breadcrumbs'][] = ['label' => 'Ccars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ccar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
