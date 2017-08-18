<?php
/**
 * Created by PhpStorm.
 * User: BF
 * Date: 2017/5/5
 * Time: 14:26
 */
namespace frontend\assets;

use yii\web\AssetBundle;

class VideoAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
      //  'http://vjs.zencdn.net/5.0.2/video-js.css'
        'video-js/video-js.css'
    ];
    public $js = [
        'http://vjs.zencdn.net/ie8/1.1.0/videojs-ie8.min.js',
       // 'http://vjs.zencdn.net/5.0.2/video.js',
        'video-js/video-js.js'
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}