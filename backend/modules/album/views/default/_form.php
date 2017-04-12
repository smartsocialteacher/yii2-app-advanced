<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use app\widgets\CKEditor;
use kartik\widgets\FileInput;
use kartik\widgets\DatePicker;
/* @var $this yii\web\View */
/* @var $model backend\modules\album\models\TbAlbum */
/* @var $form yii\widgets\ActiveForm */
use backend\modules\album\models\TbAlbumCategory;
$cate = TbAlbumCategory::find()->all();
$albumCate = ArrayHelper::map($cate,'album_cate_id','album_cate_title');
?>



<?php $form = ActiveForm::begin(); ?>
<div class='row'>
  
    <div class="col-sm-12">    
        <?= $form->field($model, 'album_title')->textInput(['maxlength' => true]) ?>
        <div class='row'>
            <div class="col-sm-6">
        <?= $form->field($model, 'album_cate_id')->dropDownList($albumCate,['prompt' => 'เลือกหมวด']) ?>
            </div>
            <div class="col-sm-6">
        <?= $form->field($model, 'album_published')->dropDownList([ '0', '1', ], ['prompt' => '']) ?>
            </div>
        </div>
       
    </div>
</div>

 <div class='row'>
    <div class="col-sm-6">
    <?= $form->field($model, 'album_date_create')->widget(DatePicker::classname(), [
        'language' =>  \Yii::$app->language,
        'value' =>  date('Y-m-d'),
        'removeButton' => false,
        'pickerButton' => ['icon' => 'calendar'],
        'pluginOptions' => [
           'autoclose'=>true,
           'format' => 'yyyy-mm-dd',
        ],
        'pluginEvents' => [
             //"show" => "function(e) {   }",
             "hide" => "function(e) {  "
            //. "alert(e.date); "
            //. "day  = e.date.getDate(), "
           // . "month = e.date.getMonth()+1, "
           // . "year =  e.date.getFullYear(); "
            . "check_path(); "
           // . "$('#tbalbum-album_path').val(year + '-' + month + '-' + day); "
            . "}",
         ]
        
    ])?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'album_path')->textInput(['readonly' => true,'placeholder' => 'ให้เลือกหมวดและวันที่สร้าง ตำแหน่งก็จะถูกกำหนดขึ้นมา']) ?>
    </div>

</div>
        <div class='row'>
            <div class="col-sm-12">
                 <?= $form->field($model, 'album_detail')->widget(CKEditor::className(), [
                    'options' => ['rows' => 3],
                    'preset' => 'custom',
                    'clientOptions' => [
                        'toolbarGroups' => [	           
                            ['name' => 'basicstyles', 'groups' => ['basicstyles']],
                        ],
                    ],
                ])  ?>
            </div>
        </div>

<div class='row'>
<div class='col-sm-12'>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</div>
</div>
    <?php ActiveForm::end(); ?>

<?php
$this->registerJs("
$('#tbalbum-album_cate_id').change(function(){
    check_path();
});

var check_path=function(){
    //alert(11);
    var cate_id = $('#tbalbum-album_cate_id').find('option:selected').val();
    var date_create = $('#tbalbum-album_date_create').val();
    
    if(cate_id&&date_create){
        $.get(
            '".Url::base(true)."/album/default/catetitle',
            {cate_id:cate_id},
            function(data){
                //alert(55);
                $('#tbalbum-album_path').val(data.album_cate_folder+'/'+date_create);
            });
        };
    }




");

?>