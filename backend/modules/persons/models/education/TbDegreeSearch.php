<?php

namespace backend\modules\persons\models\education;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\persons\models\education\TbDegree;

/**
 * TbDegreeSearch represents the model behind the search form about `backend\modules\persons\models\education\TbDegree`.
 */
class TbDegreeSearch extends TbDegree
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['degree_id'], 'integer'],
            [['degree_title'], 'safe'],
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
        $query = TbDegree::find();

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
            'degree_id' => $this->degree_id,
        ]);

        $query->andFilterWhere(['like', 'degree_title', $this->degree_title]);

        return $dataProvider;
    }
}
