<?php

namespace backend\modules\user\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\user\models\TbUserProfilePsu;

/**
 * TbUserProfilePsuSearch represents the model behind the search form about `app\modules\user\models\TbUserProfilePsu`.
 */
class TbUserProfilePsuSearch extends TbUserProfilePsu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'user_idcard', 'antecedent_id'], 'integer'],
            [['user_name', 'user_surname', 'user_nickname', 'user_sex', 'user_data'], 'safe'],
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
        $query = TbUserProfilePsu::find();

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
            'user_id' => $this->user_id,
            'user_idcard' => $this->user_idcard,
            'antecedent_id' => $this->antecedent_id,
        ]);

        $query->andFilterWhere(['like', 'user_name', $this->user_name])
            ->andFilterWhere(['like', 'user_surname', $this->user_surname])
            ->andFilterWhere(['like', 'user_nickname', $this->user_nickname])
            ->andFilterWhere(['like', 'user_sex', $this->user_sex])
            ->andFilterWhere(['like', 'user_data', $this->user_data]);

        return $dataProvider;
    }
}
