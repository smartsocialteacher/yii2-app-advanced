<?php

namespace frontend\controllers;

use backend\modules\persons\models\TbPerson;

class PersonController extends \yii\web\Controller {

    public function actionIndex($id) {

        if (!empty($id)) {

            $model = TbPerson::find()->with('comments')->where(['person_id'=>$id])->one();
            return $this->render('index', [
                'model'=>$model
            ]);
        }
    }

}
