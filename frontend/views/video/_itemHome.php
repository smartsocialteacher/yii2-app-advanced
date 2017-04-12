<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->registerCss("  
    
.videoThumbnail{
    position:relation;
}
.videoThumbnail .icon{
    position:absolute;
    top:35%;
    left:40%;
    font-size:50px;
    color: #1BC1AE !important;
    text-shadow: 0 1px 3px #142E26;
}
.videoThumbnail:hover .icon{  
    color: #0F685E !important;
}
");
?>

<div class="blog-post blog-media wow fadeInRight" data-wow-duration="300ms" data-wow-delay="100ms">
                        <article class="media clearfix">
                           
                            <div class="entry-thumbnail pull-left videoThumbnail">
                                <?=Html::a("<i class='fa fa-youtube-play icon'></i>".Html::img($model->yt_thumbnailURL,['alt'=>$model->yt_title,'width'=>'100%']),$url)?>                                   
                               
                            </div>                          
                            
                            <div class="media-body">
                                <header class="entry-header">                                    
                                    <h2 class="entry-title"><?=Html::a("<i class='fa fa-youtube-play '></i> ".$model->yt_title,$url)?> 
                                    <?=Html::tag('small',$model->yt_author)?></h2>
                                   
                                </header>
                            </div>
                        </article>
                    </div>
