<?php

namespace backend\modules\slide\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\slide\models\TbSlide;

/**
 * TbSlideSearch represents the model behind the search form about `backend\modules\slide\models\TbSlide`.
 */
class TbSlideSearch extends TbSlide
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slide_id', 'slide_cate_id', 'user_id'], 'integer'],
            [['slide_title', 'img_id', 'slide_link', 'slide_date_create', 'slide_published', 'slide_sort', 'slide_start', 'slide_end'], 'safe'],
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
        $query = TbSlide::find();

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
            'slide_id' => $this->slide_id,
            'slide_cate_id' => $this->slide_cate_id,
            'slide_date_create' => $this->slide_date_create,
            'slide_start' => $this->slide_start,
            'slide_end' => $this->slide_end,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'slide_title', $this->slide_title])
            ->andFilterWhere(['like', 'img_id', $this->img_id])
            ->andFilterWhere(['like', 'slide_link', $this->slide_link])
            ->andFilterWhere(['like', 'slide_published', $this->slide_published])
            ->andFilterWhere(['like', 'slide_sort', $this->slide_sort]);

        return $dataProvider;
    }
}
