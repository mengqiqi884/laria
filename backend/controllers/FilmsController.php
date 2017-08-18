<?php

namespace backend\controllers;

use frontend\helpers\StringHelper;
use Yii;
use backend\models\FFilms;
use backend\models\FFilmsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FilmsController implements the CRUD actions for FFilms model.
 */
class FilmsController extends Controller
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
     * 上映中
     */
    public function actionFilmOnIndex()
    {
        $searchModel = new FFilmsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,'on');
        $dataProvider->pagination = [
            'pageSize' => 20,
        ];
        $dataProvider->sort = [
            'defaultOrder' => ['created_time'=>SORT_DESC,'release_time'=>SORT_ASC]
        ];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'mode' => 'on'
        ]);
    }

    /*
     * 已下架
     */
    public function actionFilmOffIndex()
    {
        $searchModel = new FFilmsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,'off');
        $dataProvider->pagination = [
            'pageSize' => 20,
        ];
        $dataProvider->sort = [
            'defaultOrder' => ['created_time'=>SORT_DESC,'release_time'=>SORT_ASC]
        ];


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'mode' => 'off'
        ]);
    }

    /*
     * 即将上映
     */
    public function actionFilmSoonIndex()
    {
        $searchModel = new FFilmsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,'soon');
        $dataProvider->pagination = [
            'pageSize' => 20,
        ];
        $dataProvider->sort = [
            'defaultOrder' => ['created_time'=>SORT_DESC,'release_time'=>SORT_ASC]
        ];


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'mode' => 'soon'
        ]);
    }

    /**
     * Displays a single FFilms model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id,$mode)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'mode' => $mode
        ]);
    }

    /**
     * Creates a new FFilms model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FFilms();
        $film_arr = Yii::$app->request->post('FFilms');
        if ($film_arr) {
            $model->attributes = $film_arr;
            $model->id = StringHelper::createGuid();
            $model->pic = $film_arr['bus_pic'];
            $model->created_time = date('Y--m-d H:i:s');
            $model->updated_time = date('Y-m-d H:i:s');

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                return $this->render('create', [
                    'model' => $model,
                ]);
            }

        } else {
            $model->level = '2D';
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     *编辑
     */
    public function actionUpdate($id,$mode)
    {
        $model = $this->findModel($id);

        $film_arr = Yii::$app->request->post('FFilms');
        if ($film_arr) {
            $model->attributes = $film_arr;
            $model->pic = $film_arr['bus_pic'];
            $model->updated_time = date('Y-m-d H:i:s');

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id,'mode' =>$mode]);
            }else{
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /*
     * 下架/上架
     */
    public function actionDown($id,$mode)
    {
        $model = $this->findModel($id);
        if($model->state == 1){
            $model->state = 0;
        }else{
            $model->state = 1;
        }
        $model->save();
        return $this->redirect([$mode=='on' ? 'film-on-index' : ($mode=='off' ? 'film-off-index':'film-soon-index')]);
    }
    /**
     * Deletes an existing FFilms model.
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
     * Finds the FFilms model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return FFilms the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FFilms::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
