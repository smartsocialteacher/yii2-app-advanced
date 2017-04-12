<?php

namespace frontend\controllers;
use Yii;
use backend\modules\persons\models\teach\TbSchool;
use backend\modules\persons\models\teach\TbSchoolSearch;

class SchoolController extends \yii\web\Controller
{
    public function actionIndex($id=NULL)
    {
        if($id!==NULL){
            $model = TbSchool::findOne($id);
            return $this->render('index',
                    [
                        'model'=>$model
                    ]
                    );
        }else{
            
            
          
            $school = new TbSchoolSearch();
            $dataProvider = $school->search(Yii::$app->request->queryParams);
            $dataProvider->query->where(['school_type'=>'1']);
            $dataProvider->pagination->pageSize = 10;
           // $dataProvider->sort->defaultOrder = ['art_id'=>'DESC'];
            return $this->render('list', [                
                'dataProvider' =>$dataProvider,
            ]);
        }
        
        
    }

}
