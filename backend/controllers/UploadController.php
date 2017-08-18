<?php
/**
 * Created by PhpStorm.
 * User: BF
 * Date: 2017/6/13
 * Time: 11:15
 */

namespace backend\controllers;


use backend\models\FFilms;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;
use yii\web\UploadedFile;

class UploadController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post', 'get'],
                ],
            ],
        ];
    }

    /*上传图片*/
    public function actionImg()
    {
        $flag = Yii::$app->request->get('type'); //type=banner

        $file_name = $flag . '_' . time();

        if (Yii::$app->request->isPost) {
            $basePath = $_SERVER['DOCUMENT_ROOT'] . '/' . Yii::$app->params['base_file'];
            $dir = '';
            $type = '';
            switch ($flag) {
                case 'film':
                    $Info = new FFilms();
                    $dir = '/photo/films/' . date('Ymd') . '/';
                    $type = 'pic';
                    break;

            }
            $path = $basePath . $dir; //图片路径
            $res = array();
            $img = UploadedFile::getInstance($Info, $type);
            if ($img) {
                if ($img->size > 2048 * 1024) {
                    echo json_encode(['error' => '图片最大不可超过2M']);
                    exit;
                }
                if (!in_array(strtolower($img->extension), array('gif', 'jpg', 'jpeg', 'png'))) {
                    echo json_encode(['error' => '请上传标准图片文件, 支持gif,jpg,png和jpeg.']);
                    exit;
                }

                if (!is_dir($path) || !is_writable($path)) {
                    @mkdir($path, 0777, true);
                }

                $filePath = $path . $file_name . '.' . $img->extension;

                if ($img->saveAs($filePath)) {
                    $url = $dir;

                    $img_url = $url . $file_name . '.' . $img->extension;

                    echo json_encode([
                        'imageUrl' => $img_url,
                        'error' => '',
                    ]);
                    exit;
                }
            } else {
                echo json_encode([
                    'imageUrl' => '',
                    'error' => '保存图片失败，请重试',
                ]);
                exit;
            }
        } else {
            echo json_encode([
                'imageUrl' => '',
                'error' => '未获取到图片信息',
            ]);
            exit;
        }
    }

    /*上传视频
     *array(5) {
          ["name"]=>
          string(8) "test.mp3"
          ["type"]=>
          string(10) "audio/mpeg"
          ["tmp_name"]=>
          string(22) "C:\Windows\phpA398.tmp"
          ["error"]=>
          int(0)
          ["size"]=>
          int(35816)
        }
     */
    public function actionVideo()
    {
        if (Yii::$app->request->isPost) {
            $filename = $_POST['filename'];

            $vname = $_FILES[$filename]['name'];
            $vsize = $_FILES[$filename]['size'];
            $tmpname = $_FILES[$filename]['tmp_name'];

            $p1 = [];
            $p2 = [];

            if (empty($vname)) {
                echo '{}';
                return;
            }else{

                if ($vsize > 20 * 1024000) {
                    echo '视频大小不能超过20M';
                    exit;
                }else{
                    $type = strstr($vname, '.');
                    if ($type != ".mp3" && $type != ".mp4" && $type != ".ogg" && $type != ".rmvb") {
                        echo '视频格式不对！';
                        exit;
                    } else {
                        $Dir = "/video/film/";
                        //上传路径
                        $pic_path = $_SERVER['DOCUMENT_ROOT'] . '/' . Yii::$app->params['base_file'] . $Dir;

                        if (!is_dir($pic_path)) {
                            $res = @mkdir($pic_path, 0777, true);
                            if (!$res) {
                                echo "对不起！头像目录创建失败！";
                                exit;
                            }
                        }

                        //保存图片
                        move_uploaded_file($tmpname, $pic_path . $vname);

                       // $p1[] = "<img src='http://path.to.uploaded.file/Animal-1.jpg'>"; //封面图
                        $p1[]="<video src='http://localhost/".Yii::$app->params['base_file']. $Dir.$vname. "' controls='controls'>";   //视频播放地址
                        $p2 = [
                            'caption' => $vname,   //视频名称
                            'size' => $vsize,  //视频大小
                            'width' => '120px',
                            'key' => $vname
                        ];

                        echo json_encode([
                            'initialPreview' => $p1,
                            'initialPreviewConfig' => $p2,
                        ]);
                        exit;
                    }
                }

            }
        } else {
            echo json_encode(['error' => '获取上传控件失败']);
            return;
        }
    }

}