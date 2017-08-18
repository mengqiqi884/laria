<?php

namespace backend\controllers;

use Yii;
use backend\models\FRechargeOrder;
use backend\models\FRechargeOrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RechargeOrderController implements the CRUD actions for FRechargeOrder model.
 */
class RechargeOrderController extends Controller
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
     * Lists all FRechargeOrder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FRechargeOrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     *查看每个月的报表
     */
    public function actionView($month)
    {
        $sql = '';
        $sql .= 'select sum(a.money) as amount,a.user_id,b.username,DATE_FORMAT(a.create_time,\'%Y-%m-%d\') AS dates ';
        $sql .= 'from f_recharge_order as a ';
        $sql .= 'left join user as b on b.id=a.user_id ';
        $sql .= 'where a.state>0 AND DATE_FORMAT(a.create_time,\'%Y-%m\')="'.$month.'" ';
        $sql .= 'GROUP BY a.user_id,dates';

        $data = Yii::$app->db->createCommand($sql)->queryAll();


        $datetime = []; //获取该月盈利的日期
        $userid = []; //用户
        $money = [];

        if($data){

            $userid = array_merge(array_unique($this->array_get_by_key($data, 'user_id')));  //统计该月份下所有下过订单且支付过的用户 【过滤重复值并排序】
            $datetime = array_merge(array_unique($this->array_get_by_key($data, 'dates')));   //统计该月份下所有成功支付过的订单日期 【过滤重复值并排序】

            for($j=0;$j<count($userid);$j++){
                for($i=0;$i<count($datetime);$i++){
                    $money[$userid[$j]][$datetime[$i]] = 0;
                }
            }

            for($i=0;$i<count($userid);$i++){

                foreach($data as $key=>$item){

                    if($item['user_id']==$userid[$i]){
                        $money[$item['user_id']][$item['dates']] = intval($item['amount']);
                        if(!isset($arr[$item['user_id']]) ){
                            $arr[$item['user_id']] = [
                                'name' =>  $item['username'],
                                'data' => []
                            ];
                        }
                    }
                }
                $arr[$userid[$i]]['data'] = array_values($money[$userid[$i]]);

            }
        }

        return $this->render('view', [
            'month' => $month,
            'datetime' => $datetime,
            'money' => $money,
            'arr' => array_merge($arr)
        ]);
    }

    /**
     * Creates a new FRechargeOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FRechargeOrder();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FRechargeOrder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FRechargeOrder model.
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
     * Finds the FRechargeOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return FRechargeOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FRechargeOrder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    /*将对象数组转成普通数组*/
    public static function std_class_object_to_array($stdclassobject)
    {
        $array =[];

        $_array = is_object($stdclassobject) ? get_object_vars($stdclassobject) : $stdclassobject;
        foreach ($_array as $key => $value) {
            $value = (is_array($value) || is_object($value)) ? self::std_class_object_to_array($value) : $value;
            $array[$key] = $value;
        }
        return $array;
    }

    /*
    author: yangyu@sina.cn
    description: 根据某一特定键(下标)取出一维或多维数组的所有值；不用循环的理由是考虑大数组的效率，把数组序列化，然后根据序列化结构的特点提取需要的字符串
    */
    function array_get_by_key(array $array, $string){
        if (!trim($string)) return false;
        preg_match_all("/\"$string\";\w{1}:(?:\d+:|)(.*?);/", serialize($array), $res);
        return str_replace("\"","",$res[1]);
    }
}
