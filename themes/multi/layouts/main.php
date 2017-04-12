<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
/**
 * @var $this \yii\base\View
 * @var $content string
 */
use themes\multi\assets\ThemeAsset;
$asset=ThemeAsset::register($this);

?>
<?php $this->beginPage() ?>
<!--ลืมใส่แล้วจะมีปัญญาขึ้น 400-->
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" >
<head>
    
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
<!--    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Responsive Onepage HTML Template | Multi</title>-->
	<!-- core CSS -->
    <link href="<?=$asset->baseUrl?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=$asset->baseUrl?>/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?=$asset->baseUrl?>/assets/css/animate.min.css" rel="stylesheet">
    <link href="<?=$asset->baseUrl?>/assets/css/owl.carousel.css" rel="stylesheet">
    <link href="<?=$asset->baseUrl?>/assets/css/owl.transitions.css" rel="stylesheet">
    <link href="<?=$asset->baseUrl?>/assets/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?=$asset->baseUrl?>/assets/fonts/thaisansneue/stylesheet.css" rel="stylesheet">
    <link href="<?=$asset->baseUrl?>/assets/css/main.css" rel="stylesheet">
    <link href="<?=$asset->baseUrl?>/assets/css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="<?=$asset->baseUrl?>/assets/js/html5shiv.js"></script>
    <script src="<?=$asset->baseUrl?>/assets/js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="<?=$asset->baseUrl?>/assets/images/ico/favicon2.ico">
<!--    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=$asset->baseUrl?>/assets/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=$asset->baseUrl?>/assets/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=$asset->baseUrl?>/assets/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?=$asset->baseUrl?>/assets/images/ico/apple-touch-icon-57-precomposed.png">-->
     <?php $this->head() ?>
</head><!--/head-->

<body id="home" class="homepage">
 <?php $this->beginBody() ?>
    <!--header-->
    <?= $this->render(
            'header.php',
            ['asset' => $asset]
        ) ?>
    <!--/header-->
    
    
     <?php 
    //echo Url::current().'='.Url::home();
    //echo Yii::$app->controller->getRoute();
    // Check Home
    //$home=Url::home().'site/index';
    if( Url::current() == (Url::home().'site/index')){?> 
    <!--#main-slider-->
    <?= $this->render(
            'home.php',
            [
                'asset' => $asset,
                'content'=>$content
            ]
        ) ?>
    <!--/#main-slider-->
    <?php }else{ ?>
    <?= $this->render(
            'content_half_layout.php',
            [
                'asset' => $asset,
                'content'=>$content
            ]
        ) ?>  
    <?php } ?>

   
    <!--#footer-->
    <?= $this->render(
            'footer.php',
            [
                'asset' => $asset,                
            ]
        ) ?>   
    <!--/#footer-->

    <script src="<?=$asset->baseUrl?>/assets/js/jquery.js"></script>
    <script src="<?=$asset->baseUrl?>/assets/js/bootstrap.min.js"></script>
<!--    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>-->
    <script src="<?=$asset->baseUrl?>/assets/js/owl.carousel.min.js"></script>
    <script src="<?=$asset->baseUrl?>/assets/js/mousescroll.js"></script>
    <script src="<?=$asset->baseUrl?>/assets/js/smoothscroll.js"></script>
    <script src="<?=$asset->baseUrl?>/assets/js/jquery.prettyPhoto.js"></script>
    <script src="<?=$asset->baseUrl?>/assets/js/jquery.isotope.min.js"></script>
    <script src="<?=$asset->baseUrl?>/assets/js/jquery.inview.min.js"></script>
    <script src="<?=$asset->baseUrl?>/assets/js/wow.min.js"></script>
    <script src="<?=$asset->baseUrl?>/assets/js/main.js"></script>
    
    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>