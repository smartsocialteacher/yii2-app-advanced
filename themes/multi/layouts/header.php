<?php

use yii\helpers\Html;
//use yii\widgets\Menu;
use yii\bootstrap\Nav;
use yii\helpers\Url;

//use dmstr\widgets\Menu;
#use common\components\languageSwitcher;
$urlImg = Yii::$app->img->getUploadUrl('user') . Yii::$app->user->identity->profile->user_img;
?>


<header id="header">
    <nav id="main-menu" class="navbar navbar-default" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">
                    <img src="<?= $asset->baseUrl ?>/assets/images/logo.png" alt="logo" height="125" class="logo" >
                    <img src="<?= $asset->baseUrl ?>/assets/images/logo-h.png" alt="logo" height="50" class="logo h" >
                </a>
            </div>

            <div class="navbar-collapse collapse navbar-right bar-menu" >

                <?php
                echo Nav::widget([
                    'options' => ['class' => "nav navbar-nav"], // set this to nav-tab to get tab-styled navigation
                    'encodeLabels' => false,
                    'items' => [
                        [
                            'label' => 'หน้าหลัก',
                            'format' => 'html',
                            'url' => ['/'],
                        //'linkOptions' => [...],
                        ],
                        [
                            'label' => 'เกี่ยวกับโครงการ',
                            'url' => "#",
                            'items' => [
                                ['label' => 'หลักการและเหตุผล', 'url' => Url::to(['/news', 'id' => '12'])],
                                ['label' => 'วัตถุประสงค์', 'url' => Url::to(['/news', 'id' => '13'])],
                                ['label' => 'Framework งานวิจัย', 'url' => Url::to(['/news', 'id' => '14'])],
                                ['label' => 'นักวิจัย', 'url' => '#'],
                                ['label' => 'ผู้ให้การสนับสนุน', 'url' => '#'],
                                ['label' => 'โมเดลจากงานวิจัย', 'url' => '#'],
                            ],
                        ],
                        [
                            'label' => 'เครือข่าย',
                            'url' => ['site/network'],
                            'items' => [
                                ['label' => 'โรงเรียน', 'url' => ['/school']],
                                ['label' => 'ครู', 'url' => '#'],
                            ]
                        ],
                        [
                            'label' => 'กิจกรรมโครงการ',
                            'url' => ['/activity'],
                            'items' => [
                                ['label' => 'สัมมนา 1', 'url' => '#'],
                                ['label' => 'Workshop 1', 'url' => '#'],
                                ['label' => 'Workshop 2', 'url' => '#'],
                                ['label' => 'Workshop 3', 'url' => '#'],
                                ['label' => 'Workshop 4', 'url' => '#'],
                                ['label' => 'Workshop 5', 'url' => '#'],
                                ['label' => 'สัมมนาครูใหญ่', 'url' => '#'],
                            ]
                        ],
                        [
                            'label' => 'ประชาสัมพันธ์',
                            'url' => ['/news'],
                        //'linkOptions' => [...],
                        ],
                        [
                            'label' => 'ติดต่อเรา',
                            'url' => ['site/contact'],
                        //'linkOptions' => [...],
                        ],
                        [
                            'label' => 'บุคลากร',
                            'url' => ['/admin'],
                            'visible' => Yii::$app->user->isGuest,
                        ],
                        [
                            'label' => 'เข้าสู่ระบบ',
                            'url' => ['site/login'],
                            'visible' => Yii::$app->user->isGuest
                        ],
                        [
                            'label' => Yii::$app->user->identity->displayname,
                            'url' => '#',
                            'visible' => (Yii::$app->user->id !== null),
                            'items' => [
                                [
                                    'label' =>
                                        '<div class="row">'
                                        . '<div class="col-sm-3">'
                                        . Html::img($urlImg, ['width' => '100%'])
                                        . '</div><div class="col-sm-9">'
                                        . Yii::$app->user->identity->displayname
                                        . Yii::$app->user->identity->displayname
                                        . "</div></div>",
                                    //'url' => '#',
                                    'encodeLabels' => true,
                                    'options' => ['class' =>'user-header']
                                ],
                                [
                                    'label' => 'ออกจากระบบ',
                                    'url' => ['site/logout'],
                                ]
                            ]
                        ],
                    ],
                ]);
                //        [
//            'label' => 'เกี่ยวกับสถาบันฯ',
//            'items' => [
//                 ['label' => 'Level 1 - Dropdown A', 'url' => '#'],
//                 '<li class="divider"></li>',
//                 '<li class="dropdown-header">Dropdown Header</li>',
//                 ['label' => 'Level 1 - Dropdown B', 'url' => '#'],
//            ],
//        ],   
                ?>

                <?php #=languageSwitcher::Widget();?>
            </div>
        </div><!--/.container-->
    </nav><!--/nav-->
</header>


