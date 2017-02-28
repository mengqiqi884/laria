<?php
namespace common\Controllers;
use Yii;
/**
 * Created by PhpStorm.
 * User: BF
 * Date: 2016/11/4
 * Time: 15:57
 */
class ApiController extends \yii\web\Controller
{
    /*
    * 结果显示,结果为空时以json返回
    */
    public function showJson($code=200,$message='',$data=[]){
        $response=Yii::$app->response;

        $result=[
            'status'=>(string)$code,
            'message'=>$message,
        ];
        if(!empty($data)){
            $result['data'] = $data;
        }else{
            $result['data'] ='';
        }

        $response->format = \yii\web\Response::FORMAT_JSON;
        return  $response->data = $result;
    }

}