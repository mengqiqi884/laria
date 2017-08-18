<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CUser;

/**
 * UserSearch represents the model behind the search form about `backend\models\CUser`.
 */
class UserSearch extends CUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['u_id', 'u_type', 'u_age', 'u_score', 'u_cars', 'u_forums', 'u_state', 'is_del'], 'integer'],
            [['u_phone', 'u_pwd', 'u_headImg', 'u_nickname', 'u_sex', 'u_token', 'u_register_id', 'created_time', 'updated_time'], 'safe'],
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
        $query = CUser::find();

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
            'u_id' => $this->u_id,
            'u_type' => $this->u_type,
            'u_age' => $this->u_age,
            'u_score' => $this->u_score,
            'u_cars' => $this->u_cars,
            'u_forums' => $this->u_forums,
            'u_state' => $this->u_state,
            'is_del' => $this->is_del,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
        ]);

        $query->andFilterWhere(['like', 'u_phone', $this->u_phone])
            ->andFilterWhere(['like', 'u_pwd', $this->u_pwd])
            ->andFilterWhere(['like', 'u_headImg', $this->u_headImg])
            ->andFilterWhere(['like', 'u_nickname', $this->u_nickname])
            ->andFilterWhere(['like', 'u_sex', $this->u_sex])
            ->andFilterWhere(['like', 'u_token', $this->u_token])
            ->andFilterWhere(['like', 'u_register_id', $this->u_register_id]);

        return $dataProvider;
    }
}
