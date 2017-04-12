<?php

namespace backend\modules\persons\models\teach;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\persons\models\teach\TbPersonnel;

/**
 * TbPersonnelSearch represents the model behind the search form about `backend\modules\persons\models\teach\TbPersonnel`.
 */
class TbPersonnelSearch extends TbPersonnel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['personnel_id', 'person_id', 'school_id', 'position_id'], 'integer'],
            [['personnel_start', 'personnel_end'], 'safe'],
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
        $query = TbPersonnel::find();

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
            'personnel_id' => $this->personnel_id,
            'personnel_start' => $this->personnel_start,
            'personnel_end' => $this->personnel_end,
            'person_id' => $this->person_id,
            'school_id' => $this->school_id,
            'position_id' => $this->position_id,
        ]);

        return $dataProvider;
    }
}
