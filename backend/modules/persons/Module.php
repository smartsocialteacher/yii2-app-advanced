<?php

namespace backend\modules\persons;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\persons\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
        //parent::init();
//        if (!isset(Yii::$app->i18n->translations['person'])) {
//            Yii::$app->i18n->translations['person'] = [
//                'class' => 'yii\i18n\PhpMessageSource',
//                //'sourceLanguage' => 'en',
//                'basePath' => '@backend/modules/person/messages'
//            ];
//        }
    }
}
