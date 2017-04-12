<?php

namespace backend\modules\persons\models\education;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\persons\models\education\TbEduLevel;

/**
 * TbEduLevelSearch represents the model behind the search form about `backend\modules\persons\models\education\TbEduLevel`.
 */
class TbEduLevelSearch extends TbEduLevel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['edu_level_id'], 'integer'],
            [['edu_level_title'], 'safe'],
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
        $query = TbEduLevel::find();

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
            'edu_level_id' => $this->edu_level_id,
        ]);

        $query->andFilterWhere(['like', 'edu_level_title', $this->edu_level_title]);

        return $dataProvider;
    }
}
