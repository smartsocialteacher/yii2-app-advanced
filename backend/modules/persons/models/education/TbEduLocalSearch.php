<?php

namespace backend\modules\persons\models\education;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\persons\models\education\TbEduLocal;

/**
 * TbEduLocalSearch represents the model behind the search form about `backend\modules\persons\models\education\TbEduLocal`.
 */
class TbEduLocalSearch extends TbEduLocal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['edu_local_id'], 'integer'],
            [['edu_local_title'], 'safe'],
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
        $query = TbEduLocal::find();

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
            'edu_local_id' => $this->edu_local_id,
        ]);

        $query->andFilterWhere(['like', 'edu_local_title', $this->edu_local_title]);

        return $dataProvider;
    }
}
