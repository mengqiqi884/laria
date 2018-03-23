<?php

namespace backend\controllers;

use Yii;
use backend\models\Admin;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * AdminController implements the CRUD actions for CAdmin model.
 */
class ManagerController extends Controller
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

    /**
     * Lists all CAdmin models.
     * @return mixed
     */
    public function actionList()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Admin::find()->where(['is_del'=>0]),
        ]);
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
            $posted = current($_POST['Admin']); //输出数组中当前元素的值，默认初始指向插入到数组中的第一个元素。移动数组内部指针，使用next()和prev()

            $post = ['Admin' => $posted];
            $output = '';
            if ($model->load($post)) { //赋值
                if(isset($posted['a_role'])){
                    $model->a_role=$posted['a_role'];
                }

                if(isset($posted['a_state'])){
                    $model->a_state = $posted['a_state'];
                }

                $model->save(); //save()方法会先调用validate()再执行insert()或者update()
                isset($posted['a_role']) && $output=Admin::getAdminRoleName($model->a_role); //登陆者当前所属角色
                isset($posted['a_state']) && $output=Admin::getAdminState($model->a_state); //登陆者当前所属角色
            }
            $out = Json::encode(['output'=>$output, 'message'=>'']);
            echo $out;
            return;
        }
        /*******************在gridview列表页面上直接修改数据 end***********************************************/



        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CAdmin model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = false;
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * 验证规则
     */
    public function actionValidForm()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = Yii::$app->request->post();
        $id = Yii::$app->request->get('id');
        $model = new Admin();
        if (!empty($id)) {
            $model->a_id = $id;
        }
        $model->load($data);

        return ActiveForm::validate($model);
    }


    /**
     * Creates a new CAdmin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Admin();

        if ($posted = Yii::$app->request->post('Admin')) {
            $transaction = Yii::$app->db->beginTransaction();
            try {

                $model->a_logo = $posted['pic'];
                $model->a_name = $posted['a_name'];
                $model->a_pwd = md5($posted['a_pwd']);
                $model->a_realname = $posted['a_realname'];
                $model->a_position = $posted['a_position'];
                $model->a_phone = $posted['a_phone'];
                $model->a_email = $posted['a_email'];
                $model->a_type = $posted['a_type'];
                $model->a_role = $posted['a_role'];
                $model->a_state = 1;
                $model->created_time = date('Y-m-d H:i:s');
                $model->updated_time = date('Y-m-d H:i:s');

                if(!$model->save()){
                    throw new Exception();
                }
                $transaction->commit();//提交
                Yii::$app->getSession()->setFlash('success','<i class="glyphicon glyphicon-ok"></i>添加成功');
            }catch(Exception $e) {
                $transaction->rollBack();

                Yii::$app->getSession()->setFlash('error','<i class="glyphicon glyphicon-remove"></i>添加失败');
            }

            return $this->redirect('list');
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CAdmin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->a_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CAdmin model.
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
     * Finds the CAdmin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * 省
     */
    public static function getProvinceList(){
        $sql = '';
        $sql .= 'select code,name from c_city where level=1 and status=1 and parent=0';
        $query = Yii::$app->db->createCommand($sql)->queryAll();

        return ArrayHelper::map($query,'code','name');
    }

    /**
     * 市
     */
    public function actionCity(){
        $out = [];
        $parents = $_POST['depdrop_parents'];
        if(isset($parents)){
            if($parents != null){
                $province_id = $parents[0];
                $out = self::getSubCityList($province_id);
                echo Json::encode(['output'=>$out,'selected'=>'']);
                return ;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    /*获取选中的省下的城市*/
    public function getSubCityList($province_id){

        $sql = '';
        $sql .= 'select code,name from c_city where level=2 and status=1 and parent='.$province_id;
        $query = Yii::$app->db->createCommand($sql)->queryAll();

        $results = ArrayHelper::getColumn($query,function($element){
            return [
                'id'=>$element['code'],
                'name'=>$element['name'],
            ];
        });

        return $results;
    }

    /**
     * 区
     */
    public function actionArea(){

        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $province_id = empty($ids[0]) ? null : $ids[0];
            $city_id = empty($ids[1]) ? null : $ids[1];
            if($province_id != null){
                $data = self::getAreaList($province_id,$city_id);
                echo Json::encode(['output'=>$data['out'],'selected'=>$data['selected']]);
                return ;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    /*获取选中的市下的区*/
    public function getAreaList($province_id,$city_id){

    }
}
