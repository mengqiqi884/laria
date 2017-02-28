<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \backend\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = '用户：'.$model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'email:email',
            'auth_key',
            'password',
            'token',
            [
                'attribute' => 'role',
                'value' => User::getUserRoleName($model->role)
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => $model->status==0?'<i class="btn btn-info fa fa-unlock-alt"> 激活</i>':'<i class="btn btn-danger fa fa-lock"> 禁用</i>',
            ],
            'created_at',
        ],
    ]) ?>
    <div class="view_app">
        <p>
            <?= Html::a('返回', ['index'], ['class' => 'btn btn-']) ?>
        </p>
    </div>
</div>
