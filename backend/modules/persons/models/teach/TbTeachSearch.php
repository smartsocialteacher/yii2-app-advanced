<?php

namespace backend\modules\persons\models\teach;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\persons\models\teach\TbTeach;

/**
 * TbTeachSearch represents the model behind the search form about `backend\modules\persons\models\teach\TbTeach`.
 */
class TbTeachSearch extends TbTeach
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['teach_id', 'subject_id', 'teach_hoursPweek', 'person_id', 'edu_class_id'], 'integer'],
            [['teach_year', 'teach_term'], 'safe'],
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
        $query = TbTeach::find();

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
            'teach_id' => $this->teach_id,
            'teach_year' => $this->teach_year,
            'subject_id' => $this->subject_id,
            'teach_hoursPweek' => $this->teach_hoursPweek,
            'person_id' => $this->person_id,
            'edu_class_id' => $this->edu_class_id,
        ]);

        $query->andFilterWhere(['like', 'teach_term', $this->teach_term]);

        return $dataProvider;
    }
}
