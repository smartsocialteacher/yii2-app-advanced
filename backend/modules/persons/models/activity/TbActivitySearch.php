<?php

namespace backend\modules\persons\models\activity;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\persons\models\activity\TbActivity;

/**
 * TbActivitySearch represents the model behind the search form about `backend\modules\persons\models\activity\TbActivity`.
 */
class TbActivitySearch extends TbActivity
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id', 'location_id', 'activity_cate_id', 'activity_status'], 'integer'],
            [['activity_title', 'activity_detail', 'activity_start', 'activity_end'], 'safe'],
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
        $query = TbActivity::find();

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
            'activity_id' => $this->activity_id,
            'activity_start' => $this->activity_start,
            'activity_end' => $this->activity_end,
            'location_id' => $this->location_id,
            'activity_cate_id' => $this->activity_cate_id,
            'activity_status' => $this->activity_status,
        ]);

        $query->andFilterWhere(['like', 'activity_title', $this->activity_title])
            ->andFilterWhere(['like', 'activity_detail', $this->activity_detail]);

        return $dataProvider;
    }
}
