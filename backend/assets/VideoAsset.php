<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class VideoAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

    ];
    public $js = [
        'js/upload_video.js',


    ];

    public $depends = [
     //   'yii\web\YiiAsset',
        //'admin\assets\IEhack',
      //  'yii\bootstrap\BootstrapAsset'
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_END];
}