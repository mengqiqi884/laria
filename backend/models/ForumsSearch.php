<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CForums;

/**
 * ForumsSearch represents the model behind the search form about `backend\models\CForums`.
 */
class ForumsSearch extends CForums
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['f_id', 'f_fup', 'f_user_id', 'f_views', 'f_replies', 'f_is_top', 'f_is_first_top', 'f_state', 'is_del'], 'integer'],
            [['f_user_nickname', 'f_pic', 'f_title', 'f_content', 'f_car_cycle', 'f_car_miles', 'f_car_describle', 'created_time', 'updated_time'], 'safe'],
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
    public function search($params)
    {
        $query = CForums::find()->where(['is_del'=>0]);

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
//            'f_id' => $this->f_id,
            'f_fup' => $this->f_fup,
//            'f_user_id' => $this->f_user_id,
//            'f_views' => $this->f_views,
//            'f_replies' => $this->f_replies,
            'f_is_top' => $this->f_is_top,
//            'f_is_first_top' => $this->f_is_first_top,
            'f_state' => $this->f_state,
//            'created_time' => $this->created_time,
//            'updated_time' => $this->updated_time,
//            'is_del' => $this->is_del,
        ]);

        $query->andFilterWhere(['like', 'f_user_nickname', $this->f_user_nickname]);
//            ->andFilterWhere(['like', 'f_pic', $this->f_pic])
//            ->andFilterWhere(['like', 'f_title', $this->f_title])
//            ->andFilterWhere(['like', 'f_content', $this->f_content])
//            ->andFilterWhere(['like', 'f_car_cycle', $this->f_car_cycle])
//            ->andFilterWhere(['like', 'f_car_miles', $this->f_car_miles])
//            ->andFilterWhere(['like', 'f_car_describle', $this->f_car_describle]);

        return $dataProvider;
    }
}
