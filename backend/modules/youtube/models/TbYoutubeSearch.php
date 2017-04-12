<?php

namespace backend\modules\youtube\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\youtube\models\TbYoutube;

/**
 * TbYoutubeSearch represents the model behind the search form about `backend\modules\youtube\models\TbYoutube`.
 */
class TbYoutubeSearch extends TbYoutube
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['yt_id'], 'integer'],
            [['yt_vid', 'yt_title', 'yt_description', 'yt_watchURL', 'yt_thumbnailURL', 'yt_viewCount', 'yt_length', 'yt_author', 'yt_date_create', 'yt_published'], 'safe'],
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
        $query = TbYoutube::find();

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
            'yt_id' => $this->yt_id,
            'yt_date_create' => $this->yt_date_create,
        ]);

        $query->andFilterWhere(['like', 'yt_vid', $this->yt_vid])
            ->andFilterWhere(['like', 'yt_title', $this->yt_title])
            ->andFilterWhere(['like', 'yt_description', $this->yt_description])
            ->andFilterWhere(['like', 'yt_watchURL', $this->yt_watchURL])
            ->andFilterWhere(['like', 'yt_thumbnailURL', $this->yt_thumbnailURL])
            ->andFilterWhere(['like', 'yt_viewCount', $this->yt_viewCount])
            ->andFilterWhere(['like', 'yt_length', $this->yt_length])
            ->andFilterWhere(['like', 'yt_author', $this->yt_author])
            ->andFilterWhere(['like', 'yt_published', $this->yt_published]);

        return $dataProvider;
    }
}
