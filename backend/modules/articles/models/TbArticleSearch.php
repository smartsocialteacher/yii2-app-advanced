<?php

namespace  backend\modules\articles\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * TbArticleSearch represents the model behind the search form about `app\modules\articles\models\TbArticle`.
 */
class TbArticleSearch extends TbArticle
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['art_id', 'art_cate_id', 'art_access', 'art_published'], 'integer'],
            [['art_title', 'art_intro', 'art_contents', 'art_images', 'art_created', 'art_created_by', 'art_modified', 'art_modified_by', 'language', 'art_start', 'art_finish', 'activity_mode'], 'safe'],
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
        $query = TbArticle::find();

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
            'art_id' => $this->art_id,
            'art_cate_id' => $this->art_cate_id,
            'art_access' => $this->art_access,
            'art_published' => $this->art_published,
            'art_created' => $this->art_created,
            'art_modified' => $this->art_modified,
            'art_start' => $this->art_start,
            'art_finish' => $this->art_finish,
        ]);

        $query->andFilterWhere(['like', 'art_title', $this->art_title])
            ->andFilterWhere(['like', 'art_intro', $this->art_intro])
            ->andFilterWhere(['like', 'art_contents', $this->art_contents])
            ->andFilterWhere(['like', 'art_images', $this->art_images])
            ->andFilterWhere(['like', 'art_created_by', $this->art_created_by])
            ->andFilterWhere(['like', 'art_modified_by', $this->art_modified_by])
            ->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'activity_mode', $this->activity_mode]);

        return $dataProvider;
    }
}
