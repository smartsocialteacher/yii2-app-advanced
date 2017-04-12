<?php

namespace backend\modules\persons\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\persons\models\TbPersonType;

/**
 * TbPersonTypeSearch represents the model behind the search form about `backend\modules\persons\models\TbPersonType`.
 */
class TbPersonTypeSearch extends TbPersonType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_type_id'], 'integer'],
            [['person_type_title'], 'safe'],
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
        $query = TbPersonType::find();

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
            'person_type_id' => $this->person_type_id,
        ]);

        $query->andFilterWhere(['like', 'person_type_title', $this->person_type_title]);

        return $dataProvider;
    }
}
