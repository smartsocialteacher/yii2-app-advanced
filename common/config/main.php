<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'TH',
    'sourceLanguage' => 'US',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
         'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'dd.MM.yyyy',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            //'currencyCode' => 'EUR',
//            'locale' => 'th_TH',
            'timeZone' => 'Asia/Bangkok',
        ],        
        'languageSwitcher' => [
            'class' => 'common\components\languageSwitcher',
        ],
        'i18n' => [
            //yii message/extract @common/config/i18n.php
            'translations' => [
                'common*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
                'person*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
            ],
            'on missingTranslation' => [
                'app\components\TranslationEventHandler',
                'handleMissingTranslation'
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'view' => [
            'theme' => [
                'class' => 'common\components\Theme',
            ],
        ],
        /* 'webc'=>[
          'class' => 'common\components\WebCom',
          ], */
        'authManager' => [
            // 'class' =>  'yii\rbac\PhpManager',
            'class' => 'yii\rbac\DbManager',
        ],
        'img' => [
            'class' => 'common\components\Img',
        ],
        'thaiFormatter' => [
            'class' => 'dixonsatit\thaiYearFormatter\ThaiYearFormatter',
        ],
        'video'=>[
            'class'=>'mxkh\VideoThumbnail\VideoThumbnail',
        ]
    ],
];
