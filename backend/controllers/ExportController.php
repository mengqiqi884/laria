<?php
/**
 * Created by PhpStorm.
 * User: BF
 * Date: 2016/11/22
 * Time: 8:41
 */

namespace backend\controllers;

use common\Controllers\ApiController;
use yii\filters\VerbFilter;

use Yii;
use yii\helpers\Json;
use yii\web\Response;
use kartik\mpdf\Pdf;
use kartik\grid\GridView;
class ExportController  extends ApiController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],

                ],
            ],
        ];
    }

    public function actionDownload()
    {
        $type = static::getPostData('export_filetype', 'html');
        $name = static::getPostData('export_filename', '导出');
        $content = static::getPostData('export_content','没有数据');
        $mime = static::getPostData('export_mime', 'text/plain');
        $encoding = static::getPostData('export_encoding', 'utf-8');
        $config = static::getPostData('export_config', '{}');
        if ($type == GridView::PDF) {
            $config = Json::decode($config);
            $this->generatePDF($content, "{$name}.pdf", $config);
            /** @noinspection PhpInconsistentReturnPointsInspection */
            return;
        }
        $this->setHttpHeaders($type, $name, $mime, $encoding);
        return $content;
    }

    protected function generatePDF($content, $filename, $config = [])
    {
        unset($config['contentBefore'], $config['contentAfter']);
        $config['filename'] = $filename;
        $config['methods']['SetAuthor'] = ['Krajee Solutions'];
        $config['methods']['SetCreator'] = ['Krajee Yii2 Grid Export Extension'];
        $config['content'] = $content;
        $pdf = new Pdf($config);
        echo $pdf->render();
    }

    protected function setHttpHeaders($type, $name, $mime, $encoding = 'utf-8')
    {
        Yii::$app->response->format = Response::FORMAT_RAW;
        if (strstr($_SERVER["HTTP_USER_AGENT"], "MSIE") == false) {
            header("Cache-Control: no-cache");
            header("Pragma: no-cache");
        } else {
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Pragma: public");
        }
        header("Expires: Sat, 26 Jul 1979 05:00:00 GMT");
        header("Content-Encoding: {$encoding}");
        header("Content-Type: {$mime}; charset={$encoding}");
        header("Content-Disposition: attachment; filename={$name}.{$type}");
        header("Cache-Control: max-age=0");
    }

    protected static function getPostData($key, $default = null)
    {
        return empty($_POST) || empty($_POST[$key]) ? $default : $_POST[$key];
    }

}