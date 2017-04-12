<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
//        'user' => [
//            'class' => 'dektrium\user\Module',
//        ],
        'gridview' => [
            'class' => '\kartik\grid\Module',
        // enter optional module parameters below - only if you need to  
        // use your own export download action or custom translation 
        // message source
        // 'downloadAction' => 'gridview/export/download',
        // 'i18n' => []
        ],
        'user' => [
            'class' => 'backend\modules\user\Module',
        ],
        'persons' => [
            'class' => 'backend\modules\persons\Module',
        ],
        'profile' => [
            'class' => 'backend\modules\user\Module',
        ],
        'rbac' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'common\models\TbUser',
                //เรียกใช้โมเดล user ของ dektrium
                ]
            ],
        ],
        'articles' => [
            'class' => 'app\modules\articles\Module',
        ],
        'system' => [
            'class' => 'app\modules\system\Moduels',
            'modules' => [
                'menu' => [
                    'class' => 'app\modules\system\modules\menu\Module',
                ],
            ],
        ],
        'album' => [
            'class' => 'app\modules\album\Module',
        ],
        'slide' => [
            'class' => 'app\modules\slide\Module',
        ],
        'filemanager' => [
            'class' => 'app\modules\filemanager\Module',
        ],
        'youtube' => [
            'class' => 'backend\modules\youtube\Module',
        ],
    // 'filemanager' =>  require(__DIR__ . '/filemanager.php') ,
    ],
    'components' => [
        'controller' => [
            'class' => 'app\components\controller',
        ],
        /** Start Pretty Url * */
        'request' => [
            'class' => 'common\components\Request',
            'web' => '/backend/web',
            'adminUrl' => '/admin',
            'baseUrl' => '/admin',
            'enableCsrfValidation' => false,
        ### problem 400 ###############
//              'csrfParam' => '_backendCSRF',
//                'csrfCookie' => [
//                'httpOnly' => true,
//                'path' => '/admin',
//            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            //'enableStrictParsing' => true, 
            'rules' => [
                // '<module:\w+>/<alias:\w+>' => '<module>/default/<alias>',
                /* '<module:\w+>/<action:\w+>' => '<module>/default/<action>',
                  '<module:\w+>/<action:\w+>/<id:\d+>' => '<module>/default/<action>', */
                // '<module:\w+>/<controller:\w+>' => '<module>/<controller>/index',
                // '<controller:\w+>/<action:\w+>' => '<controller>/<action>'
                'profile' => 'profile/default/view'
            ],
        ],
        /** End Pretty Url * */
        'user' => [
            'identityClass' => 'common\models\TbUser',
            'enableAutoLogin' => true,
//            'identityCookie' => [ ### problem 400 ###############
//                'name' => '_backendIdentity',
//                'path' => '/admin',
//                'httpOnly' => true,
//            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'img' => [
            'class' => 'common\components\Img',
        ],
        // 'view'=>[
        //     'theme' => [
        //         'class' => 'common\components\Theme',
        //         //'active'=>'AdminLTE',
        //         // 'pathMap' => [ 
        //         //     '@app/views' => [ 
        //         //         '@themes/AdminLTE'
        //         //      ]
        //         //  ],
        //         // 'basePath' => '@themes/AdminLTE',
        //         // 'baseUrl' => '@themes/AdminLTE',
        //     ],
        // ],
        'image' => [
                'class' => 'yii\image\ImageDriver',
                'driver' => 'GD',  //GD or Imagick
        ],
        'session' => [
            'name' => 'BACKENDSESSID',
            'cookieParams' => [
                'path' => '/admin',
            ],
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            //module, controller, action ที่อนุญาตให้ทำงานโดยไม่ต้องผ่านการตรวจสอบสิทธิ์
            'site/*',
            //'rbac/*',
            'some-controller/some-action',
        ]
    ],
    'params' => $params,
];
