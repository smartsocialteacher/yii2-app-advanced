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
    color: #1BC1AE!important;
    text-shadow: 0 1px 3px #142E26;
}
.videoThumbnail:hover .icon{    
    color: #0F685E !important;
}
");

$url = Url::to(['/video','id'=>$model->yt_id]); 
?>

<div class="well">
    <div class="row">
        <div class="col-sm-4 videoThumbnail">
            <?=Html::a("<i class='fa fa-youtube-play icon'></i>".Html::img($model->yt_thumbnailURL,['alt'=>$model->yt_title,'width'=>'100%','class'=>'yt_thumbnailURL']),$url)?> 
        </div>                          

        <div class="col-sm-8">
            <header class="entry-header">                                    
                <h2 class="entry-title"><?=Html::a($model->yt_title,$url)?><br /><?=Html::tag('small',$model->yt_author)?></h2>
                

            </header>
        </div>
    </div>
</div>
