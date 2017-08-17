<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>随‘心’记</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?php
$user = Yii::$app->user->identity;
$user = empty($user)?'':$user;
?>

<div class="page-group">
    <!--头部-->
    <?= $this->render(
        'head.php',
        ['user'=>$user]
    ) ?>

    <!--底部-->
    <?= $this->render(
        'foot.php'
    ) ?>

    <div class="content">
        <?= $content ?>
    </div>


</div>

<?php
    if(empty($user)){   //弹出登陆框
        $model = new \frontend\models\LoginForm();
        echo  $this->render(
            '../site/login.php',
            ['model'=>$model]
        );
    }else{    //侧边栏
        echo $this->render(
            'slider.php',
            ['user'=>$user]
        );
    }
?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>