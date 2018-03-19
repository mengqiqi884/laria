<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CAgent;

/**
 * AgentSearch represents the model behind the search form about `backend\models\CAgent`.
 */
class AgentSearch extends CAgent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['a_id', 'a_state', 'is_del'], 'integer'],
            [['a_account', 'a_pwd', 'a_name', 'a_areacode', 'a_brand', 'a_address', 'a_concat', 'a_phone', 'a_email', 'a_position', 'created_time', 'updated_time'], 'safe'],
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
        $query = CAgent::find()->where(['is_del'=>0]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if(!empty($this->created_time)){
            $date_time = explode('to',str_replace(" ","",$this->created_time));
            $query->andFilterWhere(['between','created_time',$date_time[0].' 00:00:00',$date_time[1].' 23:59:59']);
        }

        if(!empty($this->a_areacode)){
            $query->andFilterWhere(['a_areacode' => $this->a_areacode]);
        }

        if(!empty($this->a_brand)){
            $query->andFilterWhere(['a_brand' => $this->a_brand]);
        }

        if(!empty($this->a_state)) {
            $query->andFilterWhere(['a_state' => $this->a_state]);
        }

        return $dataProvider;
    }
}
