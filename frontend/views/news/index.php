<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

//\frontend\assets\AppAsset::register($this);
/* @var $this yii\web\View */
/* @var $model app\modules\articles\models\TbArticle */

$this->title = $model->art_title;
$this->params['breadcrumbs'][] = [
    'label' => $model->artCate->art_cate_title,
    'url' => ['/news']
];
$this->params['breadcrumbs'][] = $this->title;
?>


<!--<div class="section-header">
    <h3 class="section-title text-left wow fadeInDown"><?= $model->art_title ?></h3>
    <p class="text-center wow fadeInDown"><?= $model->art_contents ?></p>
    <?= $model->artCate->art_cate_title ?> - <?= Yii::$app->formatter->asDateTime($model->art_created, 'medium'); ?>
</div>-->
<div class="row">  
    
    <div class="wow">
         <h3 class="column-title fadeInDown"><?= $model->art_title ?><br/>
             <small><?= $model->artCate->art_cate_title ?> - <?=Yii::$app->formatter->asDateTime($model->art_created, 'medium'); ?></small>
         </h3>
        <div class="article-detail">
         <p class="text-center wow fadeInDown"><?= $model->art_contents ?></p>
        </div>
    <?= $model->artCate->art_cate_title ?> - <?=Yii::$app->formatter->asDateTime($model->art_created, 'medium'); ?>
    </div>
</div>
 
<?php


$this->registerJs(" 
    var urlPdf =  $('a.media,a#media').attr('href');
    $('a.media,a#media').before('<p><iframe frameborder=\"0\" height=\"700\" scrolling=\"no\" src=\"'+urlPdf+'\" width=\"100%\"></iframe></p>');
    
");
?>