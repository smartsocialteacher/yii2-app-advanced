<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\BaseStringHelper;
use backend\modules\persons\models\teach\TbSchool;


$baseUrl = Yii::getAlias('@web');
$basePath = Yii::getAlias('@webroot');
$url=Url::to(['/school','id'=>$model->school_id]);

$url_img = Yii::$app->img->chkImg(TbSchool::PATH_IMG, $model->img_id) ? Yii::$app->img->getUploadUrl(TbSchool::PATH_IMG) . $model->img_id : Yii::$app->img->getNoImg();
?>
 <?php ?>


<div class="well">
      <div class="media">
      	<a class="pull-left" href="#">
            <div class="img">
                <?=Html::img($url_img,['class'=>'media-object'])?>
            </div>
  	</a>
  	<div class="media-body">
    		
                    <?=Html::tag('h3',Html::a($model->school_title,$url),["class"=>"media-heading"])?>
          <p><?=$model->address?></p>
          <ul class="list-inline list-unstyled">
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