<?php

namespace backend\modules\persons\models\teach;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\persons\models\teach\TbSchool;

/**
 * TbSchoolSearch represents the model behind the search form about `backend\modules\persons\models\teach\TbSchool`.
 */
class TbSchoolSearch extends TbSchool
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['school_id', 'school_mu', 'tambol_id', 'amphur_id', 'province_id', 'degree_id', 'school_number_staff','school_level_id'], 'integer'],
            [['school_title', 'school_no', 'school_village', 'school_road', 'phone', 'fax', 'school_size', 'school_category'], 'safe'],
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
        $query = TbSchool::find()->with('tbSchoolLevelJions');

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
            'tbSchoolLevelJions.school_level_id' => $this->school_level_id]);
        $query->andFilterWhere([
            'school_id' => $this->school_id,
            'school_mu' => $this->school_mu,
            'tambol_id' => $this->tambol_id,
            'amphur_id' => $this->amphur_id,
            'province_id' => $this->province_id,
            'degree_id' => $this->degree_id,
            'school_number_staff' => $this->school_number_staff,
        ]);

        $query->andFilterWhere(['like', 'school_title', $this->school_title])
            ->andFilterWhere(['like', 'school_no', $this->school_no])
            ->andFilterWhere(['like', 'school_village', $this->school_village])
            ->andFilterWhere(['like', 'school_road', $this->school_road])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'school_size', $this->school_size])
            ->andFilterWhere(['like', 'school_category', $this->school_category]);

        return $dataProvider;
    }
}
