<?php

namespace backend\modules\persons\models\teacher;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\persons\models\teacher\TbClassTeacher;

/**
 * TbClassTeacherSearch represents the model behind the search form about `backend\modules\persons\models\teacher\TbClassTeacher`.
 */
class TbClassTeacherSearch extends TbClassTeacher
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class_id', 'person_id', 'edu_class_id'], 'integer'],
            [['class_year', 'class_term', 'class_room', 'class_note'], 'safe'],
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
        $query = TbClassTeacher::find();

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
            'class_id' => $this->class_id,
            'class_year' => $this->class_year,
            'person_id' => $this->person_id,
            'edu_class_id' => $this->edu_class_id,
        ]);

        $query->andFilterWhere(['like', 'class_term', $this->class_term])
            ->andFilterWhere(['like', 'class_room', $this->class_room])
            ->andFilterWhere(['like', 'class_note', $this->class_note]);

        return $dataProvider;
    }
}
