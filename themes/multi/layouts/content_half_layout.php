<?php

use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
?>

<section id="cta1">
    <div class="container">
        <div class="text-center">
            <img class="img-responsive wow fadeIn" src="<?= $asset->baseUrl ?>/assets/images/cta2/cta2-img.png" alt="" data-wow-duration="300ms" data-wow-delay="300ms" />
        </div>
    </div>
</section>

<section id="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]);
                ?>
            </div>
        </div>
    </div>
</section>

<section id="articles">
    <div class="container">
        <div class="row">


            <div class="col-sm-9" id="content" >
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>

            <div class="col-sm-3 green-gradient">
            
               <?= $this->render('/site/_article',[
                    'art_cate_id'=>'2',
                   'link'=>'article',
                    //'arts'=>$arts,
                    'asset'=>$asset,
                        ]) ?> 
               
               <hr />
               
               <?= $this->render('/site/_article',[
                    'art_cate_id'=>'1',
                   'link'=>'news',
                   
                    //'arts'=>$arts,
                    'asset'=>$asset,
                        ]) ?>
               
               <hr />
               
                <?= $this->render('/site/_link') ?>
                <?php /*= $this->render('_login') */?>
            </div>



        </div>
    </div>
</section>


