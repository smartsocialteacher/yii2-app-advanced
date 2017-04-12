<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Html;
use yii\helpers\Url;

$url = Url::to(['/person','id'=>$model->person->person_id]); 
?>
  

   
<div class="blog-post blog-media wow fadeInRight" data-wow-duration="300ms" data-wow-delay="100ms">
    <article class="media clearfix">

        <div class="entry-thumbnail pull-left">
            <?= Html::a(Html::img($model->person->image, ['alt' => $model->person->fullname, 'width' => '100%']), $url) ?> 
        </div>        
        <div class="media-body">
            <header class="entry-header">                                    
                <h2 class="entry-title"><?= Html::a($model->person->fullname, $url) ?>
                    <p><small><?= Yii::$app->thaiFormatter->asDateTime($model->person_comment_datetime, 'medium');?> <i class='fa fa-clock-o'></i></small></p>                    
                </h2>                
            </header>
            <?="<i class='fa fa-comment'></i> ".$model->person_comment_highlight?>
            <p>
            <?= Html::a('<i class="fa fa-chevron-right"></i> อ่านต่อ', Url::to(['/comment','id'=>$model->person_id,'date'=>$model->person_comment_datetime]), ['class' => 'pull-right']) ?>
        </p>
        </div>
    </article>
</div>
