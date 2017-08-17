<?php
namespace frontend\controllers;

use frontend\helpers\StringHelper;
use frontend\models\FUser;
use Yii;
use yii\base\Exception;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\LoginForm;


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
                        'actions' => ['index','smser','ajax-register','ajax-login','to-route'],
                        'allow' => true,
                        'roles' => ['?'],  //游客身份
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'], //已登录用户
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * 首页
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    /*
     *页面跳转
     */
    public function actionToRoute()
    {
        $path = Yii::$app->request->get('path','');
        if(empty($path)){
            return $this->render('index');
        }else{
            return $this->render($path);
        }
    }


    /*
     * 获取验证码
     */
    public function actionSmser()
    {
        $phone = Yii::$app->request->post('account','');
        $type = Yii::$app->request->post('type', 1);//1为注册发送 2为改密发送
        $code = strval(rand(000000,999999));

        $user = FUser::findByUsername($phone);

        switch($type){
            case 1: //注册
                if(!empty($user)){
                    return json_encode(['status'=>'500','message'=>'该手机号已被注册']);
                }
                break;
            case 2: //找回密码
                if(empty($user)){
                    return json_encode(['status'=>'500','message'=>'该手机号未注册']);
                }
                break;
        }
        Yii::$app->cache->set($phone, $code, 1800);
        return json_encode(['status'=>'200','message'=>$code]);
    }


    /*
     * 注册
     */
    public function actionAjaxRegister()
    {
        $phone = Yii::$app->request->post('account','');
        $pwd = Yii::$app->request->post('password','');
        $code = Yii::$app->request->post('code',0);

        if(empty($phone) || empty($pwd) || empty($code)){
            return json_encode(['status'=>'300','message'=>'参数错误']);
        }
        $user_code = Yii::$app->cache->get($phone);
        if($user_code==false){
            return json_encode(['status'=>'400','message'=>'验证码已过期，请重新获取']);
        }

        if($user_code!=$code){
            return json_encode(['status'=>'400','message'=>'验证码错误']);
        }
        $userModel = FUser::find()->where(['account'=>$phone])->one();
        if(!empty($userModel)){
            return json_encode(['status'=>'400','message'=>'该用户已注册']);
        }

        $userModel = new FUser();
        $userModel->attributes=[
            'id' =>StringHelper::createGuid(),
            'account'=>$phone,
            'password' => strtolower(md5($pwd)),
            'nickname' =>substr_replace($phone,'****',3,4),
            'continue_login_times'=>1,
            'last_login_time'=>date('Y-m-d H:i:s'),
            'created_time'=>date('Y-m-d H:i:s'),
            'updated_time'=>date('Y-m-d H:i:s')
        ];

        $transaction = Yii::$app->db->beginTransaction();
        try{
            if(!$userModel->save())
            {
                throw new Exception;
            }else{
                Yii::$app->user->login($userModel, 3600 * 24 * 30); //保存登录信息
            }
            $transaction->commit();//提交
           // $backurl = Yii::$app->getResponse()->redirect(Yii::$app->request->getReferrer()); //返回上一页
            return json_encode(['status'=>'200','message'=>'注册成功']);
        }catch(Exception $e){
            $transaction->rollBack();
            return json_encode(['status'=>'400','message'=>'注册失败']);
        }

    }

    /**
     *登陆
     */
    public function actionAjaxLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return json_encode(['status'=>'400','message'=>'请先登录']);
        }

        if(Yii::$app->request->post()){
            $LoginForm = Yii::$app->request->post('LoginForm');
            if(empty($LoginForm['username']) || empty($LoginForm['password'])) {
                return json_encode(['status'=>'400','message'=>'用户名或密码不能为空']);
            }

            $userModel = FUser::find()->where(['account'=>$LoginForm['username']])->one();
            if(empty($userModel)) {
                return json_encode(['status'=>'400','message'=>'用户不存在,请先注册']);
            }
            if($userModel->password!=strtolower(md5($LoginForm['password']))){
                return json_encode(['status'=>'400','message'=>'密码不存在']);
            }

            $transaction = Yii::$app->db->beginTransaction();
            try{
                $last_time = $userModel->last_login_time;
                //判断 昨日是否登陆过
                $continue_times = date('Y-m-d',strtotime($last_time)) == date("Y-m-d",strtotime("-1 day")) ? ($userModel->continue_login_times +1): 1;

                $userModel->attributes =[
                    'created_time' => date('Y-m-d H:i:s'),
                    'updated_time' => date('Y-m-d H:i:s'),
                    'last_login_time' => date('Y-m-d H:i:s'),
                    'continue_login_times' => $continue_times,
                ];

                if(!$userModel->save()){
                    throw new Exception;
                }
                Yii::$app->user->login($userModel, 3600 * 24 * 30); //保存登录信息

                $transaction->commit();//提交
                return json_encode(['status'=>'200','message'=>'登陆成功']);

            }catch(Exception $e){
                $transaction->rollBack();
                return json_encode(['status'=>'400','message'=>'登陆失败']);
            }
        }else{
            return json_encode(['status'=>'400','message'=>'用户名或密码不能为空']);
        }

    }

    /**
     * 退出
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


}
