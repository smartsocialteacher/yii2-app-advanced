<?php

namespace backend\modules\system\modules\menu\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\system\modules\menu\models\SysMenu;

/**
 * SysMenuSearch represents the model behind the search form about `app\modules\system\modules\menu\models\SysMenu`.
 */
class SysMenuSearch extends SysMenu {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['menu_id', 'menu_cate_id', 'menu_parent_id', 'mod_id', 'menu_sort'], 'integer'],
            [['menu_title', 'menu_link', 'menu_parameter', 'menu_icon', 'menu_published', 'menu_access', 'menu_target', 'menu_ptc', 'menu_params', 'menu_home', 'language', 'menu_assoc'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = SysMenu::find();

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
            'menu_id' => $this->menu_id,
            'menu_cate_id' => $this->menu_cate_id,
            'menu_parent_id' => $this->menu_parent_id,
            'mod_id' => $this->mod_id,
            'menu_sort' => $this->menu_sort,
        ]);

        $query->andFilterWhere(['like', 'menu_title', $this->menu_title])
                ->andFilterWhere(['like', 'menu_link', $this->menu_link])
                ->andFilterWhere(['like', 'menu_parameter', $this->menu_parameter])
                ->andFilterWhere(['like', 'menu_icon', $this->menu_icon])
                ->andFilterWhere(['like', 'menu_published', $this->menu_published])
                ->andFilterWhere(['like', 'menu_access', $this->menu_access])
                ->andFilterWhere(['like', 'menu_target', $this->menu_target])
                ->andFilterWhere(['like', 'menu_ptc', $this->menu_ptc])
                ->andFilterWhere(['like', 'menu_params', $this->menu_params])
                ->andFilterWhere(['like', 'menu_home', $this->menu_home])
                ->andFilterWhere(['like', 'language', $this->language])
                ->andFilterWhere(['like', 'menu_assoc', $this->menu_assoc]);

        $query->orderBy([
            'menu_cate_id' => SORT_ASC,
            'menu_sort' => SORT_ASC,
            'menu_parent_id' => SORT_ASC,
        ]);
        return $dataProvider;
    }

    public static function getItems($menu_cate_id, $show_header = false) {

        $items = [];
        $items_parent = [];
        $models = SysMenu::find()->where([
                    'menu_cate_id' => $menu_cate_id,
                    'menu_parent_id' => NULL
                ])->orderBy([
                    'menu_sort' => SORT_ASC,
                ])->all();
        foreach ($models as $model) {
            //echo strpos($model->menu_link, "://");
            $model->menu_link=strpos($model->menu_link, '://') ? $model->menu_link : \yii\helpers\Url::to([$model->menu_link]);
            if ($show_header) {
                $items[] = [
                    'label' => $model->menu_title,
                    //'url' => [$model->menu_link],
                    //'icon' => $model->menu_icon,
                    'options' => [
                        'class' => 'header'
                        
                    ]
                ];
            }
            $items_parent = SysMenuSearch::getItemsParent($model->menu_id);
            // $items_parent=($items_parent!==null)?['items'=>$items_parent]:[];
            $items[] = [
                'label' => $model->menu_title,
                'url' => $model->menu_link,
                'target'=>$model->menu_target,
                'icon' => $model->menu_icon,
                'items' => $items_parent,
                    'options' => [
                        //'class' => 'header',                        
                    ]
            ];
        }
        return $items;
    }

    public static function getItemsParent($menu_id) {
        $items = [];
        $items_parent = [];
        $models = SysMenu::find()->where(['menu_parent_id' => $menu_id])->orderBy([
                    'menu_sort' => SORT_ASC,
                ])->all();
        foreach ($models as $model) {
            $model->menu_link=strpos($model->menu_link, '://') ? $model->menu_link : [$model->menu_link];
            $items_parent = SysMenuSearch::getItemsParent($model->menu_id);
            $items[] = [
                'label' => $model->menu_title,
                'url' => $model->menu_link,
                'icon' => $model->menu_icon,
                'items' => $items_parent,                
            ];
        }
        return $items;
    }

}
