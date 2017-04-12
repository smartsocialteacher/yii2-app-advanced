<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\modules\album\models\TbAlbum;
/* @var $this yii\web\View */
/* @var $model backend\modules\album\models\TbAlbum */

$this->title = $model->album_title;
$this->params['breadcrumbs'][] = ['label' => 'Tb Albums', 'url' => ['/album']];
$this->params['breadcrumbs'][] = $this->title;

$urlImg=TbAlbum::getUploadUrl().$model->album_path."/thumbnail/".$model->album_image_intro;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>

     <?php if(Yii::$app->request->get('print')){?>
        
        
          <?= DetailView::widget([
        'model' => $model,
        'template'=>'<tr><th nowrap="">{label}</th><td>{value}</td></tr>',
        'attributes' => [
            'album_title',           
            'album_detail:html',
            'album_date_create:date',
        ],
    ]) ?>
     <?php }else{ ?>
        
    <div class="row">
    <div class='col-sm-3'>    
    <?=Html::img($urlImg,['class'=>'img-thumbnail album_image_intro','width'=>'100%'])?>
    </div>
    <div class='col-sm-9'>  
        
        
      
    <?= DetailView::widget([
        'model' => $model,
        'template'=>'<tr><th nowrap="">{label}</th><td>{value}</td></tr>',
        'attributes' => [
            //'album_id',
            'album_title',
            [
                'attribute' => 'album_cate_id',
                'value' => $model->albumCate->album_cate_title
            ],
            
            'album_detail:html',
            //'album_path',
            //'album_image_intro',
            //'album_date_create:date',
            //'album_published',
        ],
    ]) ?>
     <?php } ?>
    </div><!--box-body pad-->
</div><!--box-body pad-->
</div><!--box-body pad-->
    
<div class='box-body pad'>
     <?= dosamigos\gallery\Gallery::widget(['items' => $model->getThumbnails($model->album_path,$model->album_title)]);?>
 </div><!--box-body pad-->
    
   
 </div><!--box box-info-->
