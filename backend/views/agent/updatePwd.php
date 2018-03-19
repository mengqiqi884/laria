<?php
/**
 * Created by PhpStorm.
 * User: BF
 * Date: 2017/11/6
 * Time: 14:20
 */
use yii\widgets\ActiveForm;
use  \yii\helpers\Html;

$this->title = '`' . $model->a_name . '` 的登陆密码'  ;
$this->params['breadcrumbs'][] = ['label' => 'Cagents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->a_id, 'url' => ['view', 'id' => $model->a_id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="cagent-update">

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-content">
                        <div class="row-fluid">
                            <?php $form = ActiveForm::begin(); ?>

                            <?= $form->field($model, 'a_pwd')->passwordInput(['maxlength' => true])->label($this->title)?>

                            <div class="form-group" style="text-align: center;">
                                <?= Html::submitButton('编辑', ['class' => 'btn btn-primary']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
