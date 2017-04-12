<?php

namespace frontend\controllers;
use backend\modules\album\models\TbAlbum;

class AlbumController extends \yii\web\Controller
{
    public function actionIndex($id=null,$print=null)
    {
        if(isset($print))$this->layout='_blank';
        if(!empty($id)){
            
            
            $model=TbAlbum::findOne($id);
            return $this->render('index',
                    [
                        'model'=>$model
                    ]);
        }else{
            
            return $this->render('list',
            [
                //'model'=>$model
            ]);
        }
        
    }

}
