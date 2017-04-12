<?php

namespace backend\modules\persons\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\persons\models\TbAddress;

/**
 * TbAddressSearch represents the model behind the search form about `backend\modules\persons\models\TbAddress`.
 */
class TbAddressSearch extends TbAddress
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address_id', 'address_mu', 'tambol_id', 'amphur_id', 'province_id', 'address_zip_code', 'person_id'], 'integer'],
            [['address_no', 'address_village', 'address_road', 'address_on'], 'safe'],
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
        $query = TbAddress::find();

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
            'address_id' => $this->address_id,
            'address_mu' => $this->address_mu,
            'tambol_id' => $this->tambol_id,
            'amphur_id' => $this->amphur_id,
            'province_id' => $this->province_id,
            'address_zip_code' => $this->address_zip_code,
            'person_id' => $this->person_id,
        ]);

        $query->andFilterWhere(['like', 'address_no', $this->address_no])
            ->andFilterWhere(['like', 'address_village', $this->address_village])
            ->andFilterWhere(['like', 'address_road', $this->address_road])
            ->andFilterWhere(['like', 'address_on', $this->address_on]);

        return $dataProvider;
    }
}
