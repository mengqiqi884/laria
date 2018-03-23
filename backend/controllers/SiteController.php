<?php
namespace backend\controllers;

use backend\models\CCar;
use backend\models\COrders;
use backend\models\CUser;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','ajax-get-charts-data'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post','get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        //获取注册用户总数
        $usercount = CUser::find()->where(['is_del'=>0])->count();
        //获取订单总数
        $ordercount = COrders::find()->where(['is_del'=>0])->count();
        //获取置换车辆总数
        $carcount = CCar::find()->count();

        return $this->render('index',[
            'usercount'=>$usercount,
            'ordercount'=>$ordercount,
            'carcount'=>$carcount
        ]);
    }
    /**
     * ajax获取首页图表数据
     */
    public function actionAjaxGetChartsData(){
        Yii::$app->getResponse()->format = 'json';

        //按年份统计每月新注册用户人数
        $sql = '';
        $sql .= 'SELECT COUNT(*) AS sheets ,MONTH(created_time) AS dates FROM c_user WHERE YEAR(created_time)=YEAR(NOW()) GROUP BY  dates';
        $list = Yii::$app->db->createCommand($sql)->queryAll();

        $xdata = [];
        $ydata = [];
        //数据初始化
        for($i=1;$i<=12;$i++){
            $xdata[$i-1] = $i; //月份
            $ydata[$i-1] = 0; //新注册用户数量
        }
        if($list){
            foreach($list as $item){
                $key = $item['dates']-1;
                $ydata[$key] = intval($item['sheets']);
            }
        }

        $charts_data = [];

        for($i=0;$i<12;$i++){
            $charts_data[] = [
                $xdata[$i],$ydata[$i]
            ];
        }

        return  [
            'status' => '200',
            'message' => 'success',
            'data' => $charts_data
        ];
    }
    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $LoginForm = [
            'LoginForm'=>[
                'username' => Yii::$app->request->post('username',''),
                'password' => Yii::$app->request->post('pwd','')
            ]
        ];

        $model = new LoginForm();

        if ($model->load($LoginForm) && $model->login()) {

            if($model->UpdateModel()){
                return $this->goBack();
            }else{
                return $this->render('login', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
