<?php

namespace backend\modules\persons\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\persons\models\TbPerson;

/**
 * TbPersonSearch represents the model behind the search form about `backend\modules\persons\models\TbPerson`.
 */
class TbPersonSearch extends TbPerson
{
    public $fullName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id', 'person_id_card', 'antecedent_id', 'position_id', 'person_type_id', 'race_id', 'nationality_id', 'religion_id'], 'integer'],
            [['person_name', 'person_surname', 'person_sex', 'person_birthday', 'person_blood_groups', 'person_phone', 'person_mobile', 'person_email','fullName'], 'safe'],
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
        $query = TbPerson::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // Sorting by fullName
        $dataProvider->sort->attributes['fullName'] = [
           'asc' => ['person_name' => SORT_ASC, 'person_surname' => SORT_ASC],
           'desc' => ['person_name' => SORT_DESC, 'person_surname' => SORT_DESC],
           'default' => SORT_ASC
        ];
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'person_id' => $this->person_id,
            'person_id_card' => $this->person_id_card,
            'antecedent_id' => $this->antecedent_id,
            'person_birthday' => $this->person_birthday,
            'position_id' => $this->position_id,
            'person_type_id' => $this->person_type_id,
            'race_id' => $this->race_id,
            'nationality_id' => $this->nationality_id,
            'religion_id' => $this->religion_id,
        ]);

        // filter by person full name
        $query->andWhere('person_name LIKE "%' . $this->fullName . '%" ' .
            'OR person_surname LIKE "%' . $this->fullName . '%"'
        );
        
        
        $query->andFilterWhere(['like', 'person_name', $this->person_name])
            ->andFilterWhere(['like', 'person_surname', $this->person_surname])
            ->andFilterWhere(['like', 'person_sex', $this->person_sex])
            ->andFilterWhere(['like', 'person_blood_groups', $this->person_blood_groups])
            ->andFilterWhere(['like', 'person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'person_mobile', $this->person_mobile])
            ->andFilterWhere(['like', 'person_email', $this->person_email]);

        return $dataProvider;
    }
}
