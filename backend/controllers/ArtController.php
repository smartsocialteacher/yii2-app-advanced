<?php

namespace backend\controllers;
use backend\modules\articles\models\TbArticle;
use backend\modules\articles\models\TbArticleSearch;
use backend\modules\articles\models\TbArticleCategory;
class ArtController extends \yii\web\Controller
{
    public function actionIndex($id)
    {
        $model = new TbArticle();
        return $this->render('/articles/view', [
            'model' =>$model->findOne(['art_id'=>$id]),
        ]);
    }
    
    public function actionCate($id)
    {
        $model = new TbArticleCategory();
        $art = new TbArticleSearch();
        $dataProvider = $art->search(['art_cate_id'=>$id]);
        $dataProvider->pagination->pageSize = 3;
        $dataProvider->sort->defaultOrder = ['art_id'=>'DESC'];
        return $this->render('/articles/cate_view', [
            'cate' =>$model->findOne(['art_cate_id'=>$id]),
            'dataProvider' =>$dataProvider,
        ]);
    }

}
