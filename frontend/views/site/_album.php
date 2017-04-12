<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\BaseStringHelper;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use backend\modules\album\models\TbAlbum;

$tbAlbum = TbAlbum::find()->all();

use backend\modules\album\models\TbAlbumCategory;

$tbAlbumCate = TbAlbumCategory::find()->all();
?>


<section id="portfolio">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title text-center wow fadeInDown">ภาพกิจกรรม</h2>
<!--                <p class="text-center wow fadeInDown">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p>-->
        </div>

        <div class="text-center">
            <ul class="portfolio-filter">
                <li><a class="active" href="#" data-filter="*">All Works</a></li>
                <?php foreach ($tbAlbumCate as $model): ?>
                    <li><a href="#" data-filter=".<?= $model->album_cate_folder ?>"><?= $model->album_cate_title ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="portfolio-items">
            <?php
            if ($tbAlbum) {
                foreach ($tbAlbum as $model) {

                    $urlImg = Yii::$app->img->getUploadUrl(TbAlbum::PATH_IMG . '/' . $model->album_path);
                    $album_detail = strip_tags($model->album_detail);
                    $album_detail = BaseStringHelper::truncate($album_detail, 50);
                    ?>



                    <div class="portfolio-item <?= $model->albumCate->album_cate_folder ?>">
                        <div class="portfolio-item-inner">
                            <img class="img-responsive" src="<?= $urlImg . 'thumbnail/' . $model->album_image_intro ?>" alt="">
                            <div class="portfolio-info">
                                <h2><?= Html::a($model->album_title, Url::to(['/album', 'id' => $model->album_id])) ?></h2>
        <?= Html::tag('small', $album_detail); ?>


                                <a class="preview" href="<?= $urlImg . $model->album_image_intro ?>" rel="prettyPhoto"><i class="fa fa-eye"></i></a>
                            </div>
                        </div>
                    </div>

        <?php
    }
}
?>
        </div>

        <p>
            <?= Html::tag('h3', Html::a('<i class="fa fa-chevron-right"></i> รูปทั้งหมด', Url::to(['/album']), ['class' => 'pull-right'])) ?>
        </p>

    </div>
</section>
<!--/#portfolio-->