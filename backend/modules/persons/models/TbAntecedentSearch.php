<?php

namespace backend\modules\persons\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\persons\models\TbAntecedent;

/**
 * TbAntecedentSearch represents the model behind the search form about `backend\modules\persons\models\TbAntecedent`.
 */
class TbAntecedentSearch extends TbAntecedent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['antecedent_id'], 'integer'],
            [['antecedent_title', 'antecedent_title_sort', 'antecedent_title_en', 'antecedent_title_en_sort'], 'safe'],
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
        $query = TbAntecedent::find();

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
            'antecedent_id' => $this->antecedent_id,
        ]);

        $query->andFilterWhere(['like', 'antecedent_title', $this->antecedent_title])
            ->andFilterWhere(['like', 'antecedent_title_sort', $this->antecedent_title_sort])
            ->andFilterWhere(['like', 'antecedent_title_en', $this->antecedent_title_en])
            ->andFilterWhere(['like', 'antecedent_title_en_sort', $this->antecedent_title_en_sort]);

        return $dataProvider;
    }
}
