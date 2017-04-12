<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        /** Start Pretty Url * */
        'request' => [
            'class' => 'common\components\Request',
            'web' => '/frontend/web',
            'baseUrl' => '',
            //'enableCsrfValidation'=>false,
            'csrfParam' => '_frontendCSRF',
            
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'dd.MM.yyyy',
            'datetimeFormat' => 'dd.MM.yyyy H:i',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            //'currencyCode' => 'EUR',
//            'locale' => 'th_TH',
            'timeZone' => 'Asia/Bangkok',
        ],  
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules'=>[
               // '/register' => '/activity'
                '/network' => '/site/network',
                '/news' => '/news',
                '/article' => '/news',
                '/project' => '/news',
                //'/about' => '/news?id=6',
            ]
        ],
        /** End Pretty Url * */
        'user' => [
            'identityClass' => 'common\models\TbUser',
            'enableAutoLogin' => true,
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
        'mailer' => [
           'class' => 'yii\swiftmailer\Mailer',
                'viewPath' => '@common/mail',
                'useFileTransport' => false,
                'transport' => [
                    'class' => 'Swift_SmtpTransport',
                    //'host' => 'smtp.gmail.com',
                    'host' => 'mail.smartsocialteacher.com',
                    'username' => 'info@smartsocialteacher.com',
                    'password' => 'smartso#2016',
                    'port' => '587',                    
                    'encryption' => 'tls',
                    //'port' => '468',
                    //'encryption' => 'ssl',
                    //'pretend' => false,
                    //'driver' => 'smtp',
                ],
        ],
        'thaiFormatter' => [
            'class' => 'dixonsatit\thaiYearFormatter\ThaiYearFormatter',
        ],
    ],
    'params' => $params,
];
