<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\FFilms;

/**
 * FFilmsSearch represents the model behind the search form about `backend\models\FFilms`.
 */
class FFilmsSearch extends FFilms
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'pic', 'publisher', 'director', 'leaders', 'level', 'introduction', 'release_time', 'created_time', 'updated_time'], 'safe'],
            [['score'], 'number'],
            [['views', 'today_hot', 'state'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params,$status)
    {
        if($status=='on'){//上架中
            $query = FFilms::find()->where(['state'=>1])->andWhere(['>=','release_time',date('Y-m-d', time() - 60*60*24*30)]);
        }
        if($status=='off'){//已下架
            $query = FFilms::find()->where(['state'=>0]);
        }
        if($status== 'soon'){//即将上映
            $query = FFilms::find()->where(['state'=>1])->andWhere(['>','release_time',date('Y-m-d')]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'score' => $this->score,
            'views' => $this->views,
            'today_hot' => $this->today_hot,
            'release_time' => $this->release_time,
            'state' => $this->state,
            'created_time' => $this->created_time,
            //'updated_time' => $this->updated_time,
        ]);
        $query->andFilterWhere(['>','score',$this->score]);

        $query
            //->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'pic', $this->pic])
            ->andFilterWhere(['like', 'publisher', $this->publisher])
            ->andFilterWhere(['like', 'level', $this->level])
            ->andFilterWhere(['like', 'director', $this->director]);
           // ->andFilterWhere(['like', 'introduction', $this->introduction]);

        return $dataProvider;
    }
}
