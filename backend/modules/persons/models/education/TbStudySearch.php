<?php

namespace backend\modules\persons\models\education;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\persons\models\education\TbStudy;

/**
 * TbStudySearch represents the model behind the search form about `backend\modules\persons\models\education\TbStudy`.
 */
class TbStudySearch extends TbStudy
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['study_id', 'edu_level_id', 'person_id', 'edu_local_id', 'major_id', 'degree_id'], 'integer'],
            [['study_year_finish', 'study_toplevel'], 'safe'],
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
        $query = TbStudy::find();

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
            'study_id' => $this->study_id,
            'study_year_finish' => $this->study_year_finish,
            'edu_level_id' => $this->edu_level_id,
            'person_id' => $this->person_id,
            'edu_local_id' => $this->edu_local_id,
            'major_id' => $this->major_id,
            'degree_id' => $this->degree_id,
        ]);

        $query->andFilterWhere(['like', 'study_toplevel', $this->study_toplevel]);

        return $dataProvider;
    }
}
