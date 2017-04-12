<?php

namespace backend\modules\persons\models\education;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\persons\models\education\TbMajor;

/**
 * TbMajorSearch represents the model behind the search form about `backend\modules\persons\models\education\TbMajor`.
 */
class TbMajorSearch extends TbMajor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['major_id'], 'integer'],
            [['major_title'], 'safe'],
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
        $query = TbMajor::find();

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
            'major_id' => $this->major_id,
        ]);

        $query->andFilterWhere(['like', 'major_title', $this->major_title]);

        return $dataProvider;
    }
}
