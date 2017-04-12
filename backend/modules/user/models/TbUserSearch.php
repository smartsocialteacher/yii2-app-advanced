<?php

namespace backend\modules\user\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\user\models\TbUser;

/**
 * TbUserSearch represents the model behind the search form about `app\modules\user\models\TbUser`.
 */
class TbUserSearch extends TbUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'timestamp', 'user_status'], 'integer'],
            [['username', 'email', 'password', 'auth_key', 'displayname', 'user_timecreate'], 'safe'],
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
        $query = TbUser::find();

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
            'user_timecreate' => $this->user_timecreate,
            'timestamp' => $this->timestamp,
            'user_status' => $this->user_status,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'displayname', $this->displayname]);

        return $dataProvider;
    }
}
