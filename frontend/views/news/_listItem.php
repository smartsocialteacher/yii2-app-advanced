<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\BaseStringHelper;

$baseUrl = Yii::getAlias('@web');
$basePath = Yii::getAlias('@webroot');
$url=Url::to(['/news','id'=>$model->art_id]);
$content =strip_tags($model->art_contents);
?>
 <?php ?>


<div class="well">
      <div class="media">
      	<a class="pull-left" href="#">
            <div class="img">
            <?php $src=(empty($model->art_images))?Yii::$app->img->getNoImg():$model->art_images;?>
            <img class="media-object" src="<?=$src?>"  />
            </div>
  	</a>
  	<div class="media-body">
    		
                    <?=Html::tag('h3',Html::a($model->art_title,$url),["class"=>"media-heading"])?>
                
<!--          <p class="text-right">By Francisco</p>-->
          <p><?=BaseStringHelper::truncate($content,200);?></p>
          <ul class="list-inline list-unstyled">
  			<li><span><i class="glyphicon glyphicon-calendar"></i> <?=Yii::$app->formatter->asDateTime($model->art_created, 'medium'); ?></span></li>
<!--            <li>|</li>
            <span><i class="glyphicon glyphicon-comment"></i> 2 comments</span>
            <li>|</li>
            <li>
               <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
            </li>
            <li>|</li>
            <li>            
              <span><i class="fa fa-facebook-square"></i></span>
              <span><i class="fa fa-twitter-square"></i></span>
              <span><i class="fa fa-google-plus-square"></i></span>
            </li>-->
	</ul>
       </div>
    </div>
</div>

<?php
$this->registerCss(" 

.img{
    border:1px solid #aaa;
    width:150px;
    height:150px;
    position:relative;
    overflow:hidden;
}
.img img{
  position: absolute;
  top: 0;
  left: 0;
  min-width: 100%;
  height: 150px;
  max-width: none;
}
");