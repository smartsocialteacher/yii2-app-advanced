<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
//use yii\helpers\Url;
//use yii\web\Controller; 
/* @var $this yii\web\View */
/* @var $model app\modules\articles\models\TbArticle */
/* @var $form yii\widgets\ActiveForm */

use app\widgets\CKEditor;
//use kartik\widgets\DatePicker;
use kartik\widgets\DateTimePicker;

use backend\modules\articles\models\TbArticleCategory;
$art_cate = TbArticleCategory::find()->all();
$listCate = ArrayHelper::map($art_cate,'art_cate_id','art_cate_title');
?>



    <?php $form = ActiveForm::begin(); ?>

   

<div class="row">
    <div class='col-sm-2'>
        
    <div class="thumbnail">
        <div class="img">
      <?php $src=(empty($model->art_images))?Yii::$app->img->getNoImg():$model->art_images;?>
<img src="<?=$src?>" alt="..." class="art_images" >           
        </div>
        <div class="caption">
            <div style="height:30px;">
            <span id="res_img"></span>
            <p class="pull-right" >
                <button class="btn btn-select-img btn-left" type="button"><i class="fa fa-angle-left"></i></button>
                <button class="btn btn-select-img btn-right" type="button"><i class="fa fa-angle-right"></i></button>
            </p>
            </div>
        </div>
    </div>
        <?= $form->field($model, 'art_images')->hiddenInput()->label(false); ?>
    </div>
    <div class='col-sm-10'>

 <?= $form->field($model, 'art_title')->textInput(['maxlength' => true]) ?>

<div class="row">
<div class='col-md-6'>
    <?= $form->field($model, 'art_cate_id')->dropDownList($listCate) ?>

    <!--<?= $form->field($model, 'art_access')->textInput() ?>-->
</div>
<div class='col-md-6'>
    <?= $form->field($model, 'art_published')->dropDownList($model->artPublish, ['prompt' => '']) ?>
</div>
</div>
        
 
<div class="row">
<div class='col-md-6'>

    <?= $form->field($model, 'art_start')->widget(DateTimePicker::classname(),[
	'language' =>  \Yii::$app->language,
    'value' =>  date('Y-m-d H:i:s'),
    'removeButton' => false,
    'pickerButton' => ['icon' => 'time'],
	'pluginOptions' => [
		'autoclose' => true,
		'format' => 'yyyy-mm-dd hh:ii:ss',
	]
    
    ]); ?>
</div>

<div class='col-md-6'>
    <?= $form->field($model, 'art_finish')->widget(DateTimePicker::classname(),[
	'language' =>  \Yii::$app->language,
    'value' =>  '0000-00-00 00:00:00',
    'removeButton' => false,
    'pickerButton' => ['icon' => 'time'],
	'pluginOptions' => [
		'autoclose' => true,
		'format' => 'yyyy-mm-dd hh:ii:ss',
	]
    
    ]); ?>
</div>
</div>       
        
</div>
</div>
    <?= $form->field($model, 'art_contents')->widget(CKEditor::className(), [
        'options' => ['rows' =>20],
        'preset' => 'custom',
    	'clientOptions' => [
	        'toolbarGroups' => [
	            ['name' => 'document', 'groups' => ['mode', 'document', 'doctools' ]],
	            ['name' => 'clipboard', 'groups' => ['clipboard', 'undo' ]],
	            ['name' => 'editing', 'groups' => ['find', 'selection', 'spellchecker' ]],
	            '/',
	            ['name' => 'basicstyles', 'groups' => ['basicstyles', 'cleanup' ]],
	            ['name' => 'paragraph', 'groups' => ['list', 'indent', 'blocks', 'align', 'bidi' ]],
	            ['name' => 'links'],
	            ['name' => 'insert'],
	            '/',
	            ['name' => 'styles'],
	            ['name' => 'colors'],
	            ['name' => 'tools'],
	            ['name' => 'others']
	        ],
                'extraPlugins' => 'youtube'
   		],
    ]) ?>

     <!--
    <?= $form->field($model, 'art_intro')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'art_images')->textarea(['rows' => 6]) ?>
     -->
<?= $form->field($model, 'language')->textInput(['maxlength' => true]) ?>

<div class="row">
<div class='col-md-6'>
<?= $form->field($model, 'art_created')->textInput(['readonly' => true]) ;
            
//     ->widget(DateTimePicker::classname(), [
//    'language' =>  \Yii::$app->language,
//    'value' =>  date('Y-m-d H:i:s'),
//    'removeButton' => false,
//    'pickerButton' => ['icon' => 'time'],
//    'pluginOptions' => [
//       'autoclose'=>true,
//       'format' => 'yyyy-mm-dd hh:ii:ss',
//    ]
//    'options'=>['class'=>'form-control']
//     ]) ?>
</div>

<div class='col-md-6'>    

    <?= $form->field($model, 'art_created_by')->textInput(['maxlength' => true]) ?>
</div>
</div>


<div class="row">
<div class='col-md-6'>
    <?= $form->field($model, 'art_modified')->textInput(['readonly' => true]) ?>
</div>

<div class='col-md-6'>  
    <?= $form->field($model, 'art_modified_by')->textInput(['maxlength' => true]) ?>
</div>
</div>



    <?= $form->field($model, 'activity_mode')->dropDownList([ 1 => '1', 0 => '0', ], ['prompt' => 'เลือก']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::submitButton('apply', ['name'=>'apply','class' =>'btn btn-primary','value'=>'1']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php
$this->registerCss(" 

.img{
    border:1px solid #888;
    width:100%;
    height:150px;
    position:relative;
    overflow:hidden;
}
.img img{
/*    float:left;
    width:100%;*/
    
  position: absolute;
  top: 0;
  left: 0;
  min-width: 100%;
  height: 150px;
  max-width: none;
}
/*
.img .tools{
    position:absolute;
    bottom:2px;
    right:2px;
}*/




");
     
     
$this->registerJs(" 

var imgs=[];
var index=0;
var src;
var src_old=$('.art_images').attr('src');
var max;
var load_img =function(){
    imgs=['".Yii::$app->img->getNoImg()."'];
    var data = $('#tbarticle-art_contents').text();
    $(data).find('img').each(function(index){
        imgs.push($(this).attr('src'));
        //alert();
    });
    max=imgs.length;
    $('#res_img').text((index+1)+'/'+max);
    max=max?max-1:0;
    
}

load_img();


$.each( imgs, function( key, value ) {
  console.log( key + ':' + value );
  if(src_old==value){
  index=key;
  }
   $('#res_img').text((index+1)+'/'+(max?max+1:0));
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
    $('#res_img').text((index+1)+'/'+(max?max+1:0));
    console.log('max:'+max+' index:'+index+' src:'+src+' indexOf:'+src.indexOf('/'));
    $('.art_images').attr('src',src);
//    var art_images=src.split('/');
//    var indexOfs=art_images.length-1;
//    console.log(art_images);
    $('#tbarticle-art_images').val(src);
    
});

");
 ?>