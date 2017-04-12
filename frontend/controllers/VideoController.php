<?php

namespace frontend\controllers;
use Yii;
use backend\modules\youtube\models\TbYoutube;
use backend\modules\youtube\models\TbYoutubeSearch;


class VideoController extends \yii\web\Controller
{
    public function actionIndex($id=null)
    {
        if(isset($id)){
            $model=TbYoutube::find()->where(['yt_id'=>$id])->one();            
            return $this->render('index',[
                'model'=>$model
                    ]);
        }else{
            $model=TbYoutube::find()
                    //->where(['yt_id'=>$id])
                    ->all(); 
            
        $yt = new TbYoutubeSearch();
        $dataProvider = $yt->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 10;
        $dataProvider->sort->defaultOrder = ['yt_id'=>'DESC'];
             return $this->render('list',[
                 'dataProvider'=>$dataProvider,
                'youtube'=>$model
                    ]);
        }
        
    }

}
