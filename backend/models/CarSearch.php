<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CCar;

/**
 * CarSearch represents the model behind the search form about `backend\models\CCar`.
 */
class CarSearch extends CCar
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_code', 'c_title', 'c_parent', 'c_logo', 'c_imgoutside', 'c_imginside', 'c_volume', 'c_engine'], 'safe'],
            [['c_level', 'c_type', 'c_price', 'c_sortorder'], 'integer'],
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
        $query = CCar::find();

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
            'c_level' => $this->c_level,
            'c_type' => $this->c_type,
            'c_price' => $this->c_price,
            'c_sortorder' => $this->c_sortorder,
        ]);

        $query->andFilterWhere(['like', 'c_code', $this->c_code])
            ->andFilterWhere(['like', 'c_title', $this->c_title])
            ->andFilterWhere(['like', 'c_parent', $this->c_parent])
            ->andFilterWhere(['like', 'c_logo', $this->c_logo])
            ->andFilterWhere(['like', 'c_imgoutside', $this->c_imgoutside])
            ->andFilterWhere(['like', 'c_imginside', $this->c_imginside])
            ->andFilterWhere(['like', 'c_volume', $this->c_volume])
            ->andFilterWhere(['like', 'c_engine', $this->c_engine]);

        return $dataProvider;
    }
}
