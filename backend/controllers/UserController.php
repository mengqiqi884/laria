<?php

namespace backend\controllers;

use backend\models\CUser;
use Yii;
use backend\models\User;
use backend\models\UserSearch;
use yii\base\Exception;
use common\Controllers\ApiController;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends ApiController
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = [
            'pageSize' => 10,
        ];

        /*********************在gridview列表页面上直接修改数据 start*****************************************/
        //获取前面一部传过来的值
        if (Yii::$app->request->post('hasEditable')) {
            $id = Yii::$app->request->post('editableKey'); //获取需要编辑的数据id
            $model = $this->findModel($id);
            $out = Json::encode(['output'=>'', 'message'=>'']);
            //获取用户修改的参数（比如：角色）
            $posted = current($_POST['CUser']); //输出数组中当前元素的值，默认初始指向插入到数组中的第一个元素。移动数组内部指针，使用next()和prev()

            $post = ['CUser' => $posted];
            $output = '';
            if ($model->load($post)) { //赋值
                $model->u_state=$posted['u_state'];
                $model->save(); //save()方法会先调用validate()再执行insert()或者update()
                isset($posted['u_state']) && $output=CUser::getUserState($model->u_state); //配送人员当前状态
            }
            $out = Json::encode(['output'=>$output, 'message'=>'']);
            echo $out;
            return;
        }
        /*******************在gridview列表页面上直接修改数据 end***********************************************/
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $User=Yii::$app->request->post('User');

        if ($User) {
            $transaction = Yii::$app->db->beginTransaction();
            try{
                $model->attributes=[
                    'username'=>$User['username'],
                    'auth_key'=>Yii::$app->security->generateRandomString(),
                    'password'=>md5(Yii::$app->params['pwd_pre'].$User['userpassword']),
                    'email'=>$User['email'],
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s')
                ];
                if(!$model->save()){
                    throw new Exception;
                }
                $transaction->commit();//提交
                return $this->redirect(['index']); //页面重定向
            }catch(Exception $e){
                $transaction->rollBack();
            }
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout=false;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->u_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $model->u_state=0;
        $model->save();
        return $this->redirect(['index']);
    }

    //批量删除接口
    public function actionAjaxDeleteAll(){
        $users=Yii::$app->request->post('uids');

        $transaction = Yii::$app->db->beginTransaction();
        try{
            $f=CUser::deleteAll(['in','u_id',$users]);
            if(!$f){
                throw new Exception;
            }
            $transaction->commit();//提交
            return $this->showJson(200,'删除成功');
        }catch(Exception $e){
            $transaction->rollBack();
            return $this->showJson(500,'删除失败');
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
