<?php

namespace frontend\controllers;

use Yii;
use backend\modules\articles\models\TbArticle;
use backend\modules\articles\models\TbArticleSearch;
use backend\modules\articles\models\TbArticleCategory;

class NewsController extends \yii\web\Controller
{
    public function actionIndex($id="")
    {
        
//        var_dump(Yii::$app->urlManager->parseRequest(Yii::$app->request));
//        echo Yii::$app->request->url; echo "<br/>";
//        echo Yii::$app->controller->getRoute();
//        echo Yii::$app->controller->id;
//        echo Yii::$app->controller->action->id;
       
        //echo Yii::$app->urlManager->parseUrl(Yii::$app->request);
        //exit();
        if(isset($id)&&!empty($id)){
            $model = new TbArticle();
            $model->findOne(['art_id'=>$id]);
            return $this->render('index', [
                'model' =>$model->findOne(['art_id'=>$id]),
            ]);
        }else{
            $id='';
            $cur_url= str_replace("/",'',Yii::$app->request->url);
            
            switch ($cur_url){
                case 'article':
                    $id = 2;
                    break;
                
                case 'project':
                    $id = 3;
                    break;
                
                default :
                    $id = 1;
                    break;
            }
//            echo $cur_url;
//            echo $id;
//            exit();
            $model = new TbArticleCategory();
            $art = new TbArticleSearch();
            $dataProvider = $art->search(Yii::$app->request->queryParams);
            $dataProvider->query->where(['art_cate_id'=>$id]);
            $dataProvider->pagination->pageSize = 10;
            $dataProvider->sort->defaultOrder = ['art_id'=>'DESC'];
            return $this->render('list', [
                'model' =>$model->find()->where(['art_cate_id'=>$id])->one(),
                'dataProvider' =>$dataProvider,
            ]);
        }
        
        
    }

}
