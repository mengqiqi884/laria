<?php

namespace backend\controllers;

use backend\models\CForumReplies;
use backend\models\CUser;
use Yii;
use backend\models\CForums;
use backend\models\ForumsSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ForumsController implements the CRUD actions for CForums model.
 */
class ForumsController extends Controller
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

    /**
     * Lists all CForums models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ForumsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->sort = [
            'defaultOrder' => [
                'created_time' =>SORT_DESC
            ]
        ];

        /**************************修改帖子状态 start**********************************/
        //获取前面一部传过来的值
        if (Yii::$app->request->post('hasEditable')) {
            $id = Yii::$app->request->post('editableKey'); //获取需要编辑的数据id
            $model = $this->findModel($id);
            $out = Json::encode(['output'=>'', 'message'=>'']);
            //获取用户修改的参数（比如：角色）
            $posted = current($_POST['CForums']); //输出数组中当前元素的值，默认初始指向插入到数组中的第一个元素。移动数组内部指针，使用next()和prev()

            $post = ['CForums' => $posted];
            $output = '';
            if ($model->load($post)) { //赋值
                $model->f_state=$posted['f_state'];
                $model->save(); //save()方法会先调用validate()再执行insert()或者update()
                isset($posted['f_state']) && $output=CForums::getState($model->f_state); //帖子当前状态
            }
            $out = Json::encode(['output'=>$output, 'message'=>'']);
            echo $out;
            return;
        }
        /**************************修改帖子状态 end**********************************/

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CForums model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        //查找用户的个人信息
        $user = CUser::findOne(['u_id'=>$model->f_user_id]);
        //查找该帖子的回复信息
        $replies = CForumReplies::find()
            ->select(['c_forum_replies.fr_content','c_forum_replies.created_time','c_forum_replies.fr_replay_id','c_user.u_headImg','c_user.u_nickname'])
            ->leftJoin('c_user ','c_user.u_id=c_forum_replies.fr_user_id')
            ->where(['c_forum_replies.fr_forum_id'=>$id,'c_forum_replies.is_del'=>0])
            ->orderBy(['c_forum_replies.fr_position'=>SORT_DESC]);
        return $this->render('view', [
            'model' => $model,
            'user' => $user,
            'replies' => $replies
        ]);
    }

    /**
     * Creates a new CForums model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CForums();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->f_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CForums model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->f_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CForums model.
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
     * Finds the CForums model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CForums the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CForums::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
