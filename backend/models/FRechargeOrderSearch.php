<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\FRechargeOrder;

/**
 * FRechargeOrderSearch represents the model behind the search form about `backend\models\FRechargeOrder`.
 */
class FRechargeOrderSearch extends FRechargeOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'create_time', 'modify_time', 'trade_no', 'buyer'], 'safe'],
            [['money', 'real_pay'], 'number'],
            [['platform', 'state'], 'integer'],
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
        $query = FRechargeOrder::find()->where(['>=','state',9]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query->orderBy(['create_time'=>SORT_DESC]),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'money' => $this->money,
            'platform' => $this->platform,
            'real_pay' => $this->real_pay,
            'state' => $this->state,
        ]);

        if($this->user_id!=''){
            $user = User::find()->select('group_concat(id) as name')->where(['like','username',$this->user_id])->asArray()->one();

            $query->andFilterWhere(['in', 'user_id', explode(',',$user['name'])]);
        }

        if($this->create_time!=''){
            $arr = explode('to',str_replace(' ', '', $this->create_time));
            $query->andFilterWhere(['between','create_time' , "$arr[0] . ' 00:00:00'","$arr[1] .' 23:59:59'"]);
        }
        $query->andFilterWhere(['like', 'id', $this->id])
//            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'trade_no', $this->trade_no])
            ->andFilterWhere(['like', 'buyer', $this->buyer]);

        return $dataProvider;
    }
}
