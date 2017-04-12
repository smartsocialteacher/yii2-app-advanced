<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\BaseStringHelper;

$baseUrl = Yii::getAlias('@web');
$basePath = Yii::getAlias('@webroot');

$this->title = 'My Yii Application';
use themes\multi\assets\ThemeAsset;
$asset = ThemeAsset::register($this);
?>

<section id="blog" class="green">
    <div class="container">
        <div class="row">                
            <div class="col-sm-3">
                <?= $this->render('_login') ?>
            </div>
            <div class="col-sm-9">
                <?= $this->render('_slide') ?>
            </div>
        </div>
        
        <div class="row">                
            <div class="col-sm-3">
                <?= $this->render('_link') ?>
            </div>
            <div class="col-sm-9">
                <?= $this->render('_news',[
                    'arts'=>$arts,
                    'asset'=>$asset,
                    'baseUrl'=>$baseUrl,
                    'basePath'=>$basePath,
                        ]) ?>
            </div>
        </div>
</section>


