<?php

namespace  backend\modules\articles\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * TbArticleCategorySearch represents the model behind the search form about `app\modules\articles\models\TbArticleCategory`.
 */
class TbArticleCategorySearch extends TbArticleCategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['art_cate_id', 'art_cate_parent_id'], 'integer'],
            [['art_cate_title', 'art_cate_intro', 'art_cate_created', 'art_cate_created_by'], 'safe'],
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
        $query = TbArticleCategory::find();

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
            'art_cate_id' => $this->art_cate_id,
            'art_cate_created' => $this->art_cate_created,
            'art_cate_parent_id' => $this->art_cate_parent_id,
        ]);

        $query->andFilterWhere(['like', 'art_cate_title', $this->art_cate_title])
            ->andFilterWhere(['like', 'art_cate_intro', $this->art_cate_intro])
            ->andFilterWhere(['like', 'art_cate_created_by', $this->art_cate_created_by]);

        return $dataProvider;
    }
}
