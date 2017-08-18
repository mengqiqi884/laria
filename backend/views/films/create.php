<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\FFilms */

$this->title = '新增影片';
$this->params['breadcrumbs'][] = ['label' => '影片大本营', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ffilms-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
