<?php

namespace backend\modules\album\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
//use backend\modules\album\models\TbAlbumCategory;

/**
 * TbAlbumCategorySearch represents the model behind the search form about `backend\modules\album\models\TbAlbumCategory`.
 */
class TbAlbumCategorySearch extends TbAlbumCategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['album_cate_id', 'album_cate_parent_id'], 'integer'],
            [['album_cate_title', 'album_cate_folder'], 'safe'],
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
        $query = TbAlbumCategory::find();

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
            'album_cate_id' => $this->album_cate_id,
            'album_cate_parent_id' => $this->album_cate_parent_id,
        ]);

        $query->andFilterWhere(['like', 'album_cate_title', $this->album_cate_title])
            ->andFilterWhere(['like', 'album_cate_folder', $this->album_cate_folder]);

        return $dataProvider;
    }
    
    
//    public static function getItems($album_cate_id)
//    {
//        $items = [];
//        $items_parent = [];
//        $models = TbAlbumCategory::find()->where([
//            'album_cate_id'=>$album_cate_id,
//            'album_parent_id'=>NULL
//            ])->orderBy([
//            'album_sort' =>  SORT_ASC,                
//            ])->all();
//        foreach($models as $model) {
//            if($show_header){
//             $items[] = [
//                'label' => $model->album_title,
//                'options' => ['class' => 'header']
//                ];
//            }
//            $items_parent = TbAlbumCategorySearch::getItemsParent($model->album_id);
//            $items[] = [
//                'label' => $model->album_title,
//                'url' => [$model->album_link],
//                'icon' => $model->album_icon,
//                'items'=>$items_parent,
//                //'options' => ['class' => 'header']
//                ];
//        }
//        return $items;
//    }
//    
//    public function getItemsParent($album_id)
//    {
//        $items = [];
//        $items_parent = [];
//        $models = TbAlbumCategory::find()->where(['album_parent_id'=>$album_id])->orderBy([
//            'album_sort' =>  SORT_ASC,                
//            ])->all();
//        foreach($models as $model) {
//            $items_parent = TbAlbumCategorySearch::getItemsParent($model->album_id);
//            $items[] = [
//                'label' => $model->album_title,
//                'url' => [$model->album_link],
//                'icon' => $model->album_icon,
//                'items'=>$items_parent  
//                    ];
//        }
//        return $items;
//    }
    
    
}
 