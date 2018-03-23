<?php

namespace backend\controllers;

use backend\models\Admin;
use yii\helpers\Json;
use yii\widgets\ActiveForm;
use Yii;
use backend\models\CRole;
use yii\base\Exception;
use yii\web\Response;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RoleController implements the CRUD actions for CRole model.
 */
class OperatorController extends Controller
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
     * 运营人员列表
     */
    public function actionOperatorIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Admin::find()->where(['is_del'=>0])
        ]);
        $dataProvider->pagination = [
            'pageSize' => 10
        ];
        /*********************在gridview列表页面上直接修改数据 start*****************************************/
        //获取前面一部传过来的值
        if (Yii::$app->request->post('hasEditable')) {
            $id = Yii::$app->request->post('editableKey'); //获取需要编辑的数据id
            $model =  Admin::findOne(['a_id'=>$id]);
            $out = Json::encode(['output'=>'', 'message'=>'']);
            //获取用户修改的参数（比如：角色）
            $posted = current($_POST['Admin']); //输出数组中当前元素的值，默认初始指向插入到数组中的第一个元素。移动数组内部指针，使用next()和prev()

            $post = ['Admin' => $posted];
            $output = '';
            if ($model->load($post)) { //赋值
                if(isset($posted['a_state'])){
                    $model->a_state=$posted['a_state'];
                }
                $model->save(); //save()方法会先调用validate()再执行insert()或者update()
                isset($posted['a_state']) && $output=Admin::getAdminState($this->a_state); //当前角色描述
            }
            $out = Json::encode(['output'=>$output, 'message'=>'']);
            echo $out;
            return;
        }
        /*******************在gridview列表页面上直接修改数据 end***********************************************/


        return $this->render('operator-index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 角色列表
     */
    public function actionRoleIndex(){
        $dataProvider = new ActiveDataProvider([
            'query' => CRole::find()->where(['type'=>1,'p_level'=>0])->orderBy(['i_id'=>SORT_ASC]),
        ]);
        $dataProvider->pagination = [
            'pageSize' => 10
        ];
        /*********************在gridview列表页面上直接修改数据 start*****************************************/
        //获取前面一部传过来的值
        if (Yii::$app->request->post('hasEditable')) {
            $edit = Yii::$app->request->post('editableKey'); //获取需要编辑的数据id
            $arr = json_decode($edit, true); //多个主键时
            $model =  CRole::findOne(['i_id'=>$arr['i_id']]);
            $out = Json::encode(['output'=>'', 'message'=>'']);
            //获取用户修改的参数（比如：角色）
            $posted = current($_POST['CRole']); //输出数组中当前元素的值，默认初始指向插入到数组中的第一个元素。移动数组内部指针，使用next()和prev()

            $post = ['CRole' => $posted];
            $output = '';
            if ($model->load($post)) { //赋值
                if(isset($posted['description'])){
                    $model->description=$posted['description'];
                }
                $model->save(); //save()方法会先调用validate()再执行insert()或者update()
                isset($posted['description']) && $output=$model->description; //当前角色描述
            }
            $out = Json::encode(['output'=>$output, 'message'=>'']);
            echo $out;
            return;
        }
        /*******************在gridview列表页面上直接修改数据 end***********************************************/


        return $this->render('role-index', [
            'dataProvider' => $dataProvider,
        ]);
    }


//    /**
//     * 验证规则
//     */
//    public function actionRoleValidForm()
//    {
//        Yii::$app->response->format = Response::FORMAT_JSON;
//        $data = Yii::$app->request->post();
//        $id = Yii::$app->request->get('id');
//        $model = new CRole();
//        if (!empty($id)) {
//            $model->i_id = $id;
//        }
//        $model->load($data);
//
//        return ActiveForm::validate($model);
//    }

    /**
     * 新增运营人员
     */
    public function actionOperatorCreate(){
        $model = new Admin();
        if($posted = Yii::$app->request->post()){

        }else{
            return $this->render('create',[
                'model' => $model,
                'flag' => 'operator'
            ]);
        }
    }

    /**
     * 新增角色
     */
    public function actionRoleCreate(){
        $model = new CRole();
        if ($posted = Yii::$app->request->post()) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->load($posted);
                $model->type = 1;
                $model->rule_name = 'SHANTE';
                $model->data = 's:0:""';
                $model->level = 0;
                $model->p_level = 0;
                $model->created_at = time();
                $model->updated_at = time();

                if(!$model->save()){
                    throw new Exception();
                }
                $transaction->commit();
                Yii::$app->getSession()->setFlash('success', '<i class="glyphicon glyphicon-ok"></i>编辑成功');
                return $this->redirect('role-index');
            }catch(Exception $e){
                $transaction->rollBack();
//                Yii::$app->getSession()->setFlash('error', '<i class="glyphicon glyphicon-remove"></i>编辑失败');
                return $this->render('create', [
                    'model' => $model,
                    'flag' => 'role'
                ]);
            }

        } else {

            return $this->render('create', [
                'model' => $model,
                'flag' => 'role'
            ]);
        }
    }

//    /**
//     * 编辑角色
//     */
//    public function actionRoleUpdate($id){
//        $model = CRole::findOne(['i_id' => $id]);
//        if($posted = Yii::$app->request->post()){
//            $transaction = Yii::$app->db->beginTransaction();
//            try {
//                $model->load($posted);
//
//                $model->updated_at = time();
//
//                if(!$model->save()){
//                    throw new Exception();
//                }
//                $transaction->commit();
//                Yii::$app->getSession()->setFlash('success', '<i class="glyphicon glyphicon-ok"></i>编辑成功');
//
//            }catch(Exception $e){
//                $transaction->rollBack();
//                Yii::$app->getSession()->setFlash('error', '<i class="glyphicon glyphicon-remove"></i>编辑失败');
//            }
//            return $this->redirect('role-index');
//        }else{
//            //renderPartial不会渲染布局
//            return $this->renderPartial('update', [
//                'model' => $model,
//                'flag' => 'role'
//            ]);
//        }
//    }


    /**
     * 删除运营人员
     */
    public function actionOperatorDelete($id){
        $model = $this->findModel($id);
        $model->is_del = 0;
        $model->save();
        return $this->redirect('operator-index');
    }


    /**
     * 删除角色
     */
    public function actionRoleDelete($id){
        $model = CRole::findOne(['i_id' => $id]);
        $model->delete();
        return $this->redirect('role-index');
    }

    /**
     * Displays a single CRole model.
     * @param string $i_id
     * @param string $name
     * @return mixed
     */
    public function actionView($i_id, $name)
    {
        return $this->render('view', [
            'model' => $this->findModel($i_id, $name),
        ]);
    }

    /**
     * Creates a new CRole model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

    }

    /**
     * Updates an existing CRole model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $i_id
     * @param string $name
     * @return mixed
     */
    public function actionUpdate($i_id, $name)
    {
        $model = $this->findModel($i_id, $name);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'i_id' => $model->i_id, 'name' => $model->name]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CRole model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $i_id
     * @param string $name
     * @return mixed
     */
    public function actionDelete($i_id, $name)
    {
        $this->findModel($i_id, $name)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CRole model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $i_id
     * @param string $name
     * @return CRole the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($i_id, $name)
    {
        if (($model = CRole::findOne(['i_id' => $i_id, 'name' => $name])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
