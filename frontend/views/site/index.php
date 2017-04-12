<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\BaseStringHelper;

$baseUrl = Yii::getAlias('@web');
$basePath = Yii::getAlias('@webroot');

$this->title = 'Smart & Social Teachers';

use themes\multi\assets\ThemeAsset;

$asset = ThemeAsset::register($this);
?>

<section id="blog" class="green">
    <div class="container">
        <div class="row">
            <div class='col-sm-12'>
<?= $this->render('_slide') ?> 

            </div>
        </div>
    </div>
</section>



<section id="blog" class="green">
    <div class="container">       
        <div class="row">        

            <div class="col-sm-3">           
                <?=
                $this->render('_activity', [
                    'activity_id' => '1',
                    //'arts'=>$arts,
                    'asset' => $asset,
                    'baseUrl' => $baseUrl,
                    'basePath' => $basePath,
                ])
                ?> 
                 <?=
                $this->render('_news', [
                    'art_cate_id' => '3',
                    'link'=>'project',
                    'asset' => $asset,
                    'baseUrl' => $baseUrl,
                    'basePath' => $basePath,
                ])
                ?>    
            </div> 
            
            <div class="col-sm-3">
            <?=$this->render('_comment', [                   
                    //'arts'=>$arts,
                    'asset' => $asset,
                    'baseUrl' => $baseUrl,
                    'basePath' => $basePath,
                ])
                ?>             
            </div> 
            
            <div class="col-sm-3">                
                <?=
                $this->render('_school', [                    
                    //'arts'=>$arts,
                    'asset' => $asset,
                    'baseUrl' => $baseUrl,
                    'basePath' => $basePath,
                ])
                ?>             
            </div> 
            
            <div class="col-sm-3 green-gradient">

<?=
$this->render('_article', [
    'art_cate_id' => '2',
    'link'=>'article',
    //'arts'=>$arts,
    'asset' => $asset,
    'baseUrl' => $baseUrl,
    'basePath' => $basePath,
])
?> 

                <hr />

                <?=
                $this->render('_article', [
                    'art_cate_id' => '1',                    
                    'link'=>'news',
                    //'arts'=>$arts,
                    'asset' => $asset,
                    'baseUrl' => $baseUrl,
                    'basePath' => $basePath,
                ])
                ?>

                <hr />

<?= $this->render('_link') ?>
<?php /* = $this->render('_login') */ ?>
            </div>

        </div>

</section>



<?=
$this->render('_research', [
    //'arts'=>$arts,
    'asset' => $asset,
    'baseUrl' => $baseUrl,
    'basePath' => $basePath
        ]
)
?>





<?php /*=
$this->render('_commentSlide', [
    //'arts'=>$arts,
    'asset' => $asset,
    'baseUrl' => $baseUrl,
    'basePath' => $basePath
        ]
)*/
?>

<?=
$this->render('_album', [
    //'arts'=>$arts,
    'asset' => $asset,
    'baseUrl' => $baseUrl,
    'basePath' => $basePath
        ]
)
?>