<?php

namespace backend\modules\slide\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\slide\models\TbSlideCategory;

/**
 * TbSlideCategorySearch represents the model behind the search form about `app\modules\slide\models\TbSlideCategory`.
 */
class TbSlideCategorySearch extends TbSlideCategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slide_cate_id', 'user_id'], 'integer'],
            [['slide_cate_title'], 'safe'],
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
        $query = TbSlideCategory::find();

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
            'slide_cate_id' => $this->slide_cate_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'slide_cate_title', $this->slide_cate_title]);

        return $dataProvider;
    }
}
