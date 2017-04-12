<?php

namespace frontend\controllers;

use backend\modules\persons\models\TbPersonComment;

class CommentController extends \yii\web\Controller {

    public function actionIndex($id=null, $date=null) {


        if (!empty($id) && !empty($date)) {
            $model = TbPersonComment::findOne(['person_id' => $id, 'person_comment_datetime' => $date]);
            return $this->render('index', [
                'model' => $model
            ]);
        } else {
            $model = TbPersonComment::find()->all();
            return $this->render('list', [
                'model' => $model
            ]);
        }
    }

}
