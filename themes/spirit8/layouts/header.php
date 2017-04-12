<?php

use yii\helpers\Html;
use yii\widgets\Menu;
?>

<nav id="tf-menu" class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            
           <?= Html::a('<img src="'.$asset->baseUrl.'/assets/img/logo_text.png" />', Yii::$app->homeUrl, ['class' => 'navbar-brand']) ?>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<!--          <ul class="nav navbar-nav navbar-right">
            <li><a href="#tf-home" class="page-scroll">Home</a></li>
            <li><a href="#tf-about" class="page-scroll">About</a></li>
            <li><a href="#tf-team" class="page-scroll">Team</a></li>
            <li><a href="#tf-services" class="page-scroll">Services</a></li>
            <li><a href="#tf-works" class="page-scroll">Portfolio</a></li>
            <li><a href="#tf-testimonials" class="page-scroll">Testimonials</a></li>
            <li><a href="#tf-contact" class="page-scroll">Contact</a></li>
          </ul>-->
            <?php
              $navItems = [
                    ['label' => 'Home', 'url' => ['site/index']],
                    ['label' => 'About', 'url' => ['site/about']],
                    ['label' => 'Contact', 'url' => ['site/contact']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                ];
              echo Menu::widget([
                'options' => [
                  "class" => "nav navbar-nav navbar-right"
                ],
                'items' => $navItems
              ]);
            ?>
            
            
            
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>