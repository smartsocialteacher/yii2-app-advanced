<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\slide\models\TbSlide */
/* @var $form yii\widgets\ActiveForm */
use backend\modules\slide\models\TbSlideCategory;
use yii\helpers\ArrayHelper;
use kartik\widgets\DatePicker;
use kartik\widgets\FileInput;
use yii\helpers\Url;
use yii\bootstrap\Modal;
//use dosamigos\ckeditor\CKEditor;
use app\widgets\CKEditorOnChange;

//$slideCate = new TbSlideCategory();

$slideCate = TbSlideCategory::find()->all();
$listCate = ArrayHelper::map($slideCate, 'slide_cate_id', 'slide_cate_title');
?>


<?php
$form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data']
        ]);
?>

<?= $form->field($model, 'img_id')->hiddenInput()->label(false);?>

<div class='row'>
    <div class="col-sm-8">
        <?= $form->field($model, 'slide_title')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($model, 'slide_cate_id')->dropDownList($listCate,['prompt' => 'เลือก']) ?>
    </div>
</div>

<div class='row'> 
     <div class="col-sm-8">
        <?=$form->field($model, 'slide_link', [
            'inputTemplate' => '<div class="input-group"><span class="input-group-addon">URL:</span>{input}</div>',
        ])->textInput(['maxlength' => true])
        ?>
    </div>
    <div class="col-sm-2">
        <?= $form->field($model, 'slide_published')->dropDownList([ '0', '1',], ['prompt' => '']) ?>
    </div>
    <div class="col-sm-2">
        <?= $form->field($model, 'slide_sort')->textInput(['maxlength' => true]) ?>
    </div>
</div>



<div class='row'>
    <div class="col-sm-2">
        <?=
        $form->field($model, 'slide_start')->widget(DatePicker::classname(), [
            'language' => \Yii::$app->language,
            'value' => date('Y-m-d'),
            'removeButton' => false,
            'pickerButton' => ['icon' => 'calendar'],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
            ],
        ])
        ?>
    </div>
    <div class="col-sm-2">

        <?=
        $form->field($model, 'slide_end')->widget(DatePicker::classname(), [
            'language' => \Yii::$app->language,
            'value' => date('Y-m-d'),
            'removeButton' => false,
            'pickerButton' => ['icon' => 'calendar'],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
            ],
        ])
        ?>
    </div>
</div>    


<div class="row">
    <div class="col-sm-12">
        <div class="owl-carousel">
        <div class="item img-thumbnail img_id" style="background-image: url(<?=($model->img_id) ? Yii::$app->img->getUploadUrl($model->img->img_path_file) . $model->img_id : Yii::$app->img->getNoimg()?>);height: <?=$model->slideCate->slide_cate_height?>px;">
                <div class="slider-inner">
                    <div class="container" id="slide_detail">
                        <?=$model->slide_detail?>
                    </div>
                </div>
            </div><!--/.item-->
        </div>
        
        
<!--        <div class="img img-thumbnail" style="overflow: hidden;height: <?=$model->slideCate->slide_cate_height?>px;width: 100%;" >
<?=
Html::img(
        ($model->img_id) ? Yii::$app->img->getUploadUrl($model->img->img_path_file) . $model->img_id : Yii::$app->img->getNoimg()
        , [
    'width' => '100%',
    'class' => 'img_id',
]);
?>
            
        </div>-->
       
        
        
        <!--img-->
<?= (!$model->isNewRecord?Html::button('<i class="glyphicon glyphicon-camera"></i> โหลดรูป', ['value' => Url::to(['customer/create']), 'title' => Yii::t('person', 'Education'), 'class' => 'btn btn-default modal-img photo']):"");
            ?> 
    </div>
</div>

<?php 
$this->registerJs('       
    CKEDITOR.on("instanceCreated", function (e) {
        document.getElementById("slide_detail").innerHTML = e.editor.getData();
        e.editor.on("change", function (ev) {
           // alert(ev.editor.getData());
            document.getElementById("slide_detail").innerHTML = ev.editor.getData();
        });
    });
//
//    var config = { extraPlugins: "onchange"};
//    CKEDITOR.replace("tbslide-slide_detail", config);
        


        ');?>
<?= $form->field($model, 'slide_detail')->widget(CKEditorOnChange::className(), [
                    'options' => ['rows' => 3],
                    'preset' => 'custom',
                    'clientOptions' => [
                        'toolbarGroups' => [
                            ['name' => 'document', 'groups' => ['mode']],
                            ['name' => 'basicstyles', 'groups' => ['basicstyles']],	            
                        ],
                        'allowedContent' => true,
                    ]
                ])  ?>















<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>


<?php
Modal::begin(['id' => 'modal-img']);
$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
?>
<?=
$form->field(new \backend\modules\slide\models\TbImages, 'img_name_file')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*'],
    'pluginOptions' => [
        'uploadUrl' => Url::to(['/slide/default/uploadajax']),
        //'overwriteInitial'=>false,
        'initialPreviewShowDelete'=>true,
        'initialPreview'=> $initialPreview,
        'initialPreviewConfig'=> $initialPreviewConfig,        
         'uploadExtraData' => [
             'slide_id' => $model->slide_id,
          ],
         'maxFileCount' => 1,
                
    ], 
    'options' => ['accept' => 'image/*', 'id' => 'img_name_file']
]);
?>


<?php
ActiveForm::end();
Modal::end();

$urlImg = Url::to(['/slide/default/load-img']);
$this->registerJs(' 
    $(".photo").click(function(e) {
        //alert(55);        
        var id="'.$model->slide_id.'";       
        $("#modal-img").modal("show");        
    });    


    $("input[name=\'TbImages[img_name_file]\']").on("fileuploaded", function(event, data, previewId, index) {
    var form = data.form, files = data.files, extra = data.extra,
        response = data.response.files, reader = data.reader;
    
        response = data.response.files
        console.log("1"+form+"2"+files+"3"+extra+"4"+response+"5"+reader);
        console.log("File batch upload complete"+files);
        loadImg(response);
        $("#modal-img").modal("hide");
    });
    
    var loadImg = function($id){
        $.get(
            "' . $urlImg . '",
            {
            id:$id
            },
            function (data)
            {                
                console.log(data.src);
                $("#tbslide-img_id").val(data.id);
                 $(".img_id").css("background","url("+data.src+")");
            },"json"
        );
    }

        ');

?>