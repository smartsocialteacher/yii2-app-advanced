<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\BaseStringHelper;

if ($model->school_detail) {
    $schoolDetail = strip_tags($model->school_detail);
    $schoolDetail = BaseStringHelper::truncate($schoolDetail, 200);
} else {
    $schoolDetail = $model->address;
}
?>

<div class="blog-post blog-media wow fadeInRight" data-wow-duration="300ms" data-wow-delay="100ms">
    <article class="media clearfix">

        <div class="entry-thumbnail pull-left">
            <?= Html::a(Html::img($url_img, ['alt' => $model->school_title, 'width' => '100%']), $url) ?> 
        </div>        
        <div class="media-body">
            <header class="entry-header">                                    
                <h2 class="entry-title"><?= Html::a("<i class='fa fa-graduation-cap'></i> " . $model->getAttributeLabel('school') . $model->school_title, $url) ?>                  
                </h2>
                
        
            </header>
        <div class="entry-content"> <?= Html::tag('p', $schoolDetail)?></div>
        </div>
    </article>
</div>
