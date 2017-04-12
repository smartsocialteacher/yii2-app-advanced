<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
/**
 * @var $this \yii\base\View
 * @var $content string
 */
use themes\spirit8\assets\ThemeAsset;
$asset=ThemeAsset::register($this);
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="description" content="Spirit8 is a Digital agency one page template built based on bootstrap framework. This template is design by Robert Berki and coded by Jenn Pereira. It is simple, mobile responsive, perfect for portfolio and agency websites. Get this for free exclusively at ThemeForces.com">
    <meta name="keywords" content="bootstrap theme, portfolio template, digital agency, onepage, mobile responsive, spirit8, free website, free theme, themeforces themes, themeforces wordpress themes, themeforces bootstrap theme">
    <meta name="author" content="ThemeForces.com">-->
    
    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="<?=$asset->baseUrl?>/assets/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?=$asset->baseUrl?>/assets/img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?=$asset->baseUrl?>/assets/img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?=$asset->baseUrl?>/assets/img/apple-touch-icon-114x114.png">

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css"  href="<?=$asset->baseUrl?>/assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?=$asset->baseUrl?>/assets/fonts/font-awesome/css/font-awesome.css">

    <!-- Slider
    ================================================== -->
    <link href="<?=$asset->baseUrl?>/assets/css/owl.carousel.css" rel="stylesheet" media="screen">
    <link href="<?=$asset->baseUrl?>/assets/css/owl.theme.css" rel="stylesheet" media="screen">

    <!-- Stylesheet
    ================================================== -->
    <link rel="stylesheet" type="text/css"  href="<?=$asset->baseUrl?>/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?=$asset->baseUrl?>/assets/css/responsive.css">

    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,700,300,600,800,400' rel='stylesheet' type='text/css'>

    <script type="text/javascript" src="<?=$asset->baseUrl?>/assets/js/modernizr.custom.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!-- Navigation
    ==========================================-->
    <?= $this->render(
            'header.php',
            ['asset' => $asset]
        ) ?>

    <?php 
    echo Url::current().'='.Url::home();
    echo Yii::$app->controller->getRoute();
    // Check Home
    //$home=Url::home().'site/index';
    if( Url::current() == (Url::home().'site/index')){?> 
    <!-- Home Page
    ==========================================-->
         <?= $this->render(
            'home.php',
            ['content' => $content]
        ) ?>
        
    <?php }else{ ?>
    <div id="tf-about">
        <div class="container">
             <div class="row">
                <div class="col-md-12">
                <?= $content ?>
                </div>
             </div>
        </div>
    </div>
    
    <?php }?>
    <!-- Contact Section
    ==========================================-->
    <div id="tf-contact" class="text-center">
        <div class="container">

            <div class="row">
                <div class="col-md-8 col-md-offset-2">

                    <div class="section-title center">
                        <h2>Feel free to <strong>contact us</strong></h2>
                        <div class="line">
                            <hr>
                        </div>
                        <div class="clearfix"></div>
                        <small><em>Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</em></small>            
                    </div>

                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Message</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        
                        <button type="submit" class="btn tf-btn btn-default">Submit</button>
                    </form>

                </div>
            </div>

        </div>
    </div>

    <nav id="footer">
        <div class="container">
            <div class="pull-left fnav">
                <p>ALL RIGHTS RESERVED. COPYRIGHT © 2014. Designed by <a href="https://dribbble.com/shots/1817781--FREEBIE-Spirit8-Digital-agency-one-page-template">Robert Berki</a> and Coded by <a href="https://dribbble.com/jennpereira">Jenn Pereira</a></p>
            </div>
            <div class="pull-right fnav">
                <ul class="footer-social">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?=$asset->baseUrl?>/assets/js/jquery.1.11.1.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="<?=$asset->baseUrl?>/assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?=$asset->baseUrl?>/assets/js/SmoothScroll.js"></script>
    <script type="text/javascript" src="<?=$asset->baseUrl?>/assets/js/jquery.isotope.js"></script>

    <script src="<?=$asset->baseUrl?>/assets/js/owl.carousel.js"></script>

    <!-- Javascripts
    ================================================== -->
    <script type="text/javascript" src="<?=$asset->baseUrl?>/assets/js/main.js"></script>

  </body>
</html>