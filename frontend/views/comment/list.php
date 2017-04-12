<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<?php
 echo Html::tag('h1','ความคิดเห็นต่อโครงการ');
if ($model) {
   
    foreach ($model as $comment) {
        //echo $comment->person_comment;
        ?>
        <div class="row">
            <div class="col-sm-2">
                <div class="thumbnail">
                    <?= Html::img($comment->person->image,['class'=>'img-responsive user-photo']) ?>
                </div><!-- /thumbnail -->
            </div><!-- /col-sm-1 -->

            <div class="col-sm-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong><?=Html::a($comment->person->fullname,Url::to(['/person','id'=>$comment->person->person_id]))?></strong> <span class="text-muted"><?=Yii::$app->formatter->asDateTime($comment->person_comment_datetime, 'medium'); ?></span>
                    </div>
                    <div class="panel-body">
                        <?=$comment->person_comment;?>
                    </div><!-- /panel-body -->
                </div><!-- /panel panel-default -->
            </div><!-- /col-sm-5 -->
            </div><!-- /row -->

            <?php
        }
    }
    
    
 $this->registerCss('
  
.panel {
	position:relative;
}
.panel>.panel-heading:after,.panel>.panel-heading:before{
	position:absolute;
	top:11px;left:-16px;
	right:100%;
	width:0;
	height:0;
	display:block;
	content:" ";
	border-color:transparent;
	border-style:solid solid outset;
	pointer-events:none;
}
.panel>.panel-heading:after{
	border-width:7px;
	border-right-color:#f7f7f7;
	margin-top:1px;
	margin-left:2px;
}
.panel>.panel-heading:before{
	border-right-color:#ddd;
	border-width:8px;
}
         ');
    ?>
        
