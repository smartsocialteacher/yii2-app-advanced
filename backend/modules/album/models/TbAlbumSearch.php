<?php

namespace backend\modules\album\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\album\models\TbAlbum;

/**
 * TbAlbumSearch represents the model behind the search form about `backend\modules\album\models\TbAlbum`.
 */
class TbAlbumSearch extends TbAlbum
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['album_id', 'album_cate_id'], 'integer'],
            [['album_title', 'album_detail', 'album_path', 'album_image_intro', 'album_date_create', 'album_published'], 'safe'],
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
        $query = TbAlbum::find();

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
            'album_id' => $this->album_id,
            'album_cate_id' => $this->album_cate_id,
            'album_date_create' => $this->album_date_create,
        ]);

        $query->andFilterWhere(['like', 'album_title', $this->album_title])
            ->andFilterWhere(['like', 'album_detail', $this->album_detail])
            ->andFilterWhere(['like', 'album_path', $this->album_path])
            ->andFilterWhere(['like', 'album_image_intro', $this->album_image_intro])
            ->andFilterWhere(['like', 'album_published', $this->album_published]);

        return $dataProvider;
    }
}
