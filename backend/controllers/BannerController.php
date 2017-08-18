<?php

namespace backend\controllers;

use Yii;
use backend\models\CBanner;
use backend\models\CBannerSearch;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BannerController implements the CRUD actions for CBanner model.
 */
class BannerController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post','get'],
                ],
            ],
        ];
    }

    /**
     * Lists all CBanner models.
     * @return mixed
     */
    public function actionIndex()
    {

        $imgs = [];
        $dataProvider = CBanner::find()->orderBy(['b_sortorder'=>SORT_DESC])->asArray()->all();
        foreach($dataProvider as $data){

            if(!isset($imgs[$data['b_location']])){
                $imgs[$data['b_location']] =[];
            }
            array_push($imgs[$data['b_location']],$data);
        }
        return $this->render('index', [
            'dataProvider' => $imgs,
        ]);
    }

    /**
     * Displays a single CBanner model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CBanner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CBanner();

        if ($model->load(Yii::$app->request->post())) {

            $model->created_time = date('Y-m-d H:i:s');

            //上传图片
            $arr = $this->uploadImg('add');

            if($arr[0] =='-1'){
                return $this->render('create', [
                    'model' => $model,
                ]);
            }else{
                $model->b_img = $arr[1];
                //保存
                if(!$model->save()){
                    throw new Exception;
                }else{
                    return $this->redirect(['index']);

                }

            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CBanner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            //上传图片
            $arr = $this->uploadImg('update');

            if($arr[0]!='-2') {   //上传新的广告图
                if ($arr[0] == '-1') {  //上传失败
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                } else { //上传成功
                    $model->b_img = $arr[1];
                }
            }
            //保存
            if(!$model->save()){
                throw new Exception;
            }else{
                return $this->redirect(['index']);

            }

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CBanner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CBanner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CBanner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CBanner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    //上传图片
    private function uploadImg($act)
    {
        $re = '';
        $imgpath = '';

        $file = $_FILES['b_img'];//得到传输的数据

        //得到文件名称
        $name = $file['name'];

        if(empty($name)){
            if($act == 'create'){
                $re = '-1';
            }else{
                return ['-2','update'];  //当编辑广告图时，未上传图片
            }

        }


        $file_name = 'banner_'.time();

        $type = strtolower(substr($name,strrpos($name,'.')+1)); //得到文件类型，并且都转化成小写
        $allow_type = array('jpg','jpeg','gif','png'); //定义允许上传的类型
        //判断文件类型是否被允许上传
        if(!in_array($type, $allow_type)){
            //如果不被允许，则直接停止程序运行
            $re = '-1';
        }
        //判断是否是通过HTTP POST上传的
        if(!is_uploaded_file($file['tmp_name'])){
            //如果不是通过HTTP POST上传的
            $re = '-1';
        }
        $upload_path = $_SERVER['DOCUMENT_ROOT'] . '/' . Yii::$app->params['base_file'];; //上传文件的存放路径
        $dir = '/photo/ad/' . date('Ymd') . '/';
        $path = $upload_path . $dir;

        if (!is_dir($path) || !is_writable($path)) {
            @mkdir($path, 0777, true);
        }


        //开始移动文件到相应的文件夹
        if(move_uploaded_file($file['tmp_name'],$path.$file_name.'.'.$type)){
            $re = '1';
            $imgpath = $dir.$file_name.'.'.$type;
        }else{
            $re = '-1';
        }
        return [$re,$imgpath];
    }
}
