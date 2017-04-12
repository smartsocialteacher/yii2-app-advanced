<?php

namespace backend\modules\persons\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\persons\models\TbPersonComment;

/**
 * TbPersonCommentSearch represents the model behind the search form about `backend\modules\persons\models\TbPersonComment`.
 */
class TbPersonCommentSearch extends TbPersonComment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id'], 'integer'],
            [['person_comment_datetime', 'person_comment'], 'safe'],
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
        $query = TbPersonComment::find();

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
            'person_id' => $this->person_id,
            'person_comment_datetime' => $this->person_comment_datetime,
        ]);

        $query->andFilterWhere(['like', 'person_comment', $this->person_comment]);

        return $dataProvider;
    }
}
