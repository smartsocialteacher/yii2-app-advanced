<?php

namespace backend\modules\persons\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\persons\models\TbNationality;

/**
 * TbNationalitySearch represents the model behind the search form about `backend\modules\persons\models\TbNationality`.
 */
class TbNationalitySearch extends TbNationality
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nationality_id'], 'integer'],
            [['nationality_title'], 'safe'],
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
        $query = TbNationality::find();

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
            'nationality_id' => $this->nationality_id,
        ]);

        $query->andFilterWhere(['like', 'nationality_title', $this->nationality_title]);

        return $dataProvider;
    }
}
