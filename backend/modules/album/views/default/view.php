<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\modules\album\models\TbAlbum;
/* @var $this yii\web\View */
/* @var $model backend\modules\album\models\TbAlbum */

$this->title = $model->album_title;
$this->params['breadcrumbs'][] = ['label' => 'Tb Albums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->album_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->album_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="row">
    <div class='col-sm-2'>
    <img src="<?= TbAlbum::getUploadUrl().$model->album_path."/thumbnail/".$model->album_image_intro?>" alt="..." class="img-thumbnail album_image_intro" width="200">
    </div>
    <div class='col-sm-10'>
    <?= DetailView::widget([
        'model' => $model,
        'template'=>'<tr><th nowrap="">{label}</th><td><i class="glyphicon glyphicon-info-sign"></i> {value}</td></tr>',
        'attributes' => [
            //'album_id',
            'album_title',
            [
                'attribute' => 'album_cate_id',
                'value' => $model->albumCate->album_cate_title
            ],
            
            'album_detail:html',
            'album_path',
            'album_image_intro',
            'album_date_create:date',
            'album_published',
        ],
    ]) ?>
    
    </div><!--box-body pad-->
</div><!--box-body pad-->
</div><!--box-body pad-->
    
<div class='box-body pad'>
     <?= dosamigos\gallery\Gallery::widget(['items' => $model->getThumbnails($model->album_path,$model->album_title)]);?>
 </div><!--box-body pad-->
    
<div class='box-footer'>
     <p>
        <?= Html::a('+ Upload File', ['upload', 'id' => $model->album_id], ['class' => 'btn btn-primary']) ?>
     </p>
</div>
   
 </div><!--box box-info-->
