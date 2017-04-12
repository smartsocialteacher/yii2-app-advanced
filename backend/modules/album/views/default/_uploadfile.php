<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use kartik\widgets\FileInput;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model backend\modules\album\models\TbAlbum */
/* @var $form yii\widgets\ActiveForm */
use backend\modules\album\models\TbAlbum;
use backend\modules\album\models\TbAlbumCategory;
$cate = TbAlbumCategory::find()->all();
$albumCate = ArrayHelper::map($cate,'album_cate_id','album_cate_title');
?>



<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data']    
    ]); ?>

 <div class='box-body pad'>
<div class="row">
    <div class='col-sm-2'>
<h4>เลือกรูปหน้าปก</h4>

<img src="<?=TbAlbum::getUploadUrl().$model->album_path."/".$model->album_image_intro?>" alt="..." class="img-thumbnail album_image_intro" width="200"><br />
<button class="btn btn-select-img btn-left" type="button"><i class="fa fa-angle-left"></i></button>
<button class="btn btn-select-img btn-right" type="button"><i class="fa fa-angle-right"></i></button>

    </div>
    <div class='col-sm-10'>
    <h2 class="box-title"><?=$model->album_title?> </h2>
    <?=$model->getAttributeLabel('album_cate_id')?> : <?=$model->albumCate->album_cate_title?>  
        
<?= $form->field($model, 'album_image_intro')->hiddenInput()->label(false); ?>
<?= $form->field($model, 'album_path')->hiddenInput()->label(false); ?>
 <?= DetailView::widget([
        'model' => $model,
        'template'=>'<tr><th nowrap="">{label}</th><td><i class="glyphicon glyphicon-info-sign"></i> {value}</td></tr>',
        'attributes' => [
            // 'album_id',
            //'album_cate_id',
            //'album_title',
            'album_path',
            'album_image_intro',
            'album_date_create',
            'album_published',
            'album_detail:html',
        ],
    ]) ?>
    </div>
</div>
</div>
 <div class='box-body pad'>
<div class='row'>
<div class='col-sm-12'>
    <div class="form-group field-upload_files">
      <label class="control-label" for="upload_files[]"> ภาพถ่าย </label>
    <div>
   <?= FileInput::widget([
    'name' => 'upload_ajax[]',
    'options' => [
        'accept' => 'image/*',
        'multiple' => true
        ],
    'pluginOptions' => [
        'uploadUrl' => Url::to(['/album/default/uploadajax']),
        'overwriteInitial'=>false,
        'initialPreviewShowDelete'=>true,
       'initialPreview'=> $initialPreview,
       'initialPreviewConfig'=> $initialPreviewConfig,        
        'uploadExtraData' => [
            'album_path' => $model->album_path,
         ],
        'maxFileCount' => 100  
        ],
   
]); ?>
</div>
</div>
</div>

<div class='box-footer'>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>


<?php
$this->registerJs("
        
//$('.album_image_intro').attr('src','');


var imgs=[];
var index=0;
var src;
var src_old=$('.album_image_intro').attr('src');
var max;
var load_img =function(){
    imgs=[];
    $('.field-upload_files img.file-preview-image').each(function(index){
        imgs.push($(this).attr('src'));
        //alert();
    });
    max=imgs.length;
    max=max?max-1:0;
}
load_img();


$.each( imgs, function( key, value ) {
  console.log( key + ':' + value );
  if(src_old==value){
  index=key;
  }
});


$('.btn-select-img').click(function(){
    load_img();
    if($(this).is('.btn-left')){
        //alert('btn-left');
        index=index?index-1:0;
        src=imgs[index];
    }
    if($(this).is('.btn-right')){
        //alert('btn-right');
         index=(index<max)?index+1:max;
        src=imgs[index];
    }
    console.log('max:'+max+' index:'+index+' src:'+src+' indexOf:'+src.indexOf('/'));
    $('.album_image_intro').attr('src',src);
    var album_image_intro=src.split('/');
    var indexOfs=album_image_intro.length-1;
    console.log(album_image_intro);
    $('#tbalbum-album_image_intro').val(album_image_intro[indexOfs]);
    
});
        
        
       
");
        
?>