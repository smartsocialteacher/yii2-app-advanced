<?php

namespace backend\modules\persons\models\education;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\persons\models\teach\TbSubject;

/**
 * TbSubjectSearch represents the model behind the search form about `backend\modules\persons\models\teach\TbSubject`.
 */
class TbSubjectSearch extends TbSubject
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject_id'], 'integer'],
            [['subject_title'], 'safe'],
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
        $query = TbSubject::find();

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
            'subject_id' => $this->subject_id,
        ]);

        $query->andFilterWhere(['like', 'subject_title', $this->subject_title]);

        return $dataProvider;
    }
}
