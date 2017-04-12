<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\album\models\TbAlbum */

$this->title = 'Upload Photo';
$this->params['breadcrumbs'][] = ['label' => 'Tb Albums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    
<!--    <div class='box-header'>
     <h3 class="box-title"><?=$model->album_title?> </h3><br />
    <small><?=$model->getAttributeLabel('album_cate_id')?> : <?=$model->albumCate->album_cate_title?></small>
    </div>box-header -->
    
   

    <?= $this->render('_uploadfile', [
        'model' => $model,
        'initialPreview'=>$initialPreview,
        'initialPreviewConfig'=>$initialPreviewConfig
    ]) ?>

    </div><!--box-body pad-->
 </div><!--box box-info-->
