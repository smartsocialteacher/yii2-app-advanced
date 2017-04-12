<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Url;
use themes\multi\assets\ThemeAsset;
$asset = ThemeAsset::register($this);

use backend\modules\slide\models\TbSlide;
$slide = TbSlide::find()->where(['slide_cate_id'=>1])->all();
?>

<section id="main-slider">
        <div class="owl-carousel">
            
            <?php 
            foreach($slide as $model):                
            if($model->img):
            ?>
            <div class="item" style="background-image: url(<?=Yii::$app->img->getUploadUrl($model->img->img_path_file).$model->img->img_id?>);">
                <div class="slider-inner">
                    <div class="container">
                        <?=$model->slide_detail?>
                    </div>
                </div>
            </div><!--/.item-->
            <?php 
            endif;
            endforeach;?>
            
            
<!--            <div class="item" style="background-image: url(<?=$asset->baseUrl?>/assets/images/slider/bg2.jpg);">
                <div class="slider-inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h2> <span>ลงทะเบียน</span> เข้าร่วมประชุม / สัมมนา</h2>
                                    <p>สามารถกดเพื่อเข้าร่วมกิจกรรมต่างๆ ได้ </p>
                                    <a class="btn btn-primary btn-lg" href="<?=Url::to(['/activity'])?>">กิจกรรม</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>/.item-->
<!--            <div class="item" style="background-image: url(<?=$asset->baseUrl?>/assets/images/slider/bg3.jpg);">
                
            </div>-->
            <!--/.item-->
        </div><!--/.owl-carousel-->
    </section>
