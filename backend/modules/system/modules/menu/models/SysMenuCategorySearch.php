<?php

namespace backend\modules\system\modules\menu\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\system\modules\menu\models\SysMenuCategory;

/**
 * SysMenuCategorySearch represents the model behind the search form about `app\modules\system\modules\menu\models\SysMenuCategory`.
 */
class SysMenuCategorySearch extends SysMenuCategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_cate_id'], 'integer'],
            [['menu_cate_title', 'menu_cate_status'], 'safe'],
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
        $query = SysMenuCategory::find();

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
            'menu_cate_id' => $this->menu_cate_id,
        ]);

        $query->andFilterWhere(['like', 'menu_cate_title', $this->menu_cate_title])
            ->andFilterWhere(['like', 'menu_cate_status', $this->menu_cate_status]);

        return $dataProvider;
    }
}
