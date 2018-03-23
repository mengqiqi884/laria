<?php

namespace backend\controllers;

use Yii;
use backend\models\CAgent;
use backend\models\AgentSearch;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AgentController implements the CRUD actions for CAgent model.
 */
class AgentController extends Controller
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
     * Lists all CAgent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AgentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CAgent model.
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
     * 新增4s店
     */
    public function actionCreate()
    {
        $model = new CAgent();

        if ($posted = Yii::$app->request->post('CAgent')) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->a_account = $posted['a_account'];
                $model->a_pwd = md5($posted['a_pwd']);
                $model->a_name = $posted['a_name'];
                $model->a_areacode = $posted['a_areacode'];
                $model->a_brand = $posted['a_brand'];
                $model->a_address = $posted['a_address'];
                $model->a_concat = $posted['a_concat'];
                $model->a_phone = $posted['a_phone'];
                $model->a_email = $posted['a_email'];
                $model->a_position = $posted['a_position'];
                $model->a_state = $posted['a_state'];
                $model->created_time = $posted['created_time'];
                $model->updated_time = $posted['updated_time'];

                if(!$model->save()){
                    throw new Exception();
                }

                $transaction->commit();
                Yii::$app->getSession()->setFlash('success','<i class="glyphicon glyphicon-ok"></i>添加成功');

            }catch(Exception $e){
                $transaction->rollBack();
                Yii::$app->getSession()->setFlash('error','<i class="glyphicon glyphicon-remove"></i>添加失败');
            }

            return $this->redirect('index');

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * 编辑4s店（不包括修改4s店的登录密码）
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->post()) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->load(Yii::$app->request->post());
                $model->updated_time = date('Y-m-d H:i:s');

                if(!$model->save()){
                    throw new Exception();
                }

                $transaction->commit();
                Yii::$app->getSession()->setFlash('success','<i class="glyphicon glyphicon-ok"></i>4S店信息更新成功');

            }catch(Exception $e){
                $transaction->rollBack();
                Yii::$app->getSession()->setFlash('error','<i class="glyphicon glyphicon-remove"></i>4S店信息更新失败');
            }
            return $this->redirect(['view', 'id' => $model->a_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * 编辑4S店的登陆密码
     */
    public function actionUpdatePwd($id){
        $model = $this->findModel($id);

        if($posted = Yii::$app->request->post('CAgent')){
            if($model->a_pwd != md5($posted['a_pwd']) && $model->a_pwd != $posted['a_pwd']){
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $model->a_pwd = md5($posted['a_pwd']);
                    $model->updated_time = date('Y-m-d H:i:s');

                    if (!$model->save()) {
                        throw new Exception();
                    }

                    $transaction->commit();
                    Yii::$app->getSession()->setFlash('success', '<i class="glyphicon glyphicon-ok"></i>登陆密码编辑成功');
                }catch(Exception $e){
                    $transaction->rollBack();
                    Yii::$app->getSession()->setFlash('ERROR', '<i class="glyphicon glyphicon-remove"></i>登陆密码编辑成功');
                }
            }
            return $this->redirect('index');
        }else{
            $this->layout = false;
            return $this->render('updatePwd' , [
                'model' => $model
            ]);
        }


    }

    /**
     * Deletes an existing CAgent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->is_del = 1;
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CAgent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CAgent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CAgent::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
