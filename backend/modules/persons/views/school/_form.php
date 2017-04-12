<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\widgets\FileInput;
use app\widgets\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\teach\TbSchool */
/* @var $form yii\widgets\ActiveForm */
use backend\modules\persons\models\address\TbProvince;
use backend\modules\persons\models\address\TbAmphur;
use backend\modules\persons\models\address\TbTambol;
use backend\modules\persons\models\TbAddress;
use backend\modules\persons\models\teach\TbSchoolLevelJion;
use backend\modules\persons\models\teach\TbSchool;

$listAmphur = ArrayHelper::map(TbAddress::itemAmphurList($model->province_id), 'amphur_id', 'amphur_name');
$listTambol = ArrayHelper::map(TbAddress::itemTambolList($model->amphur_id), 'tambol_id', 'tambol_name');

use backend\modules\persons\models\teach\TbSchoolLevel;

$listSchoolLevel = ArrayHelper::map(TbSchoolLevel::find()->all(), 'school_level_id', 'school_level_title');
?>

<div class="tb-school-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'img_id')->hiddenInput()->label(FALSE); ?>
    <?= $form->field($model, 'img_id_old')->hiddenInput()->label(FALSE); ?>
    
    <div class="row">
        
        <div class="col-sm-2">
            <div class="img img-thumbnail" style="overflow: hidden;height: 200px;width: 100%;" >
<?=
Html::img(
        ($model->img_id) ? Yii::$app->img->getUploadUrl(TbSchool::PATH_IMG) . $model->img_id : Yii::$app->img->getNoimg()
        , [
    'width' => '100%',
    'class' => 'img_id',
]);
?>
            <?= (!$model->isNewRecord?Html::button('<i class="glyphicon glyphicon-camera"></i>', ['value' => Url::to(['customer/create']), 'title' => Yii::t('person', 'Education'), 'class' => 'btn btn-default modal-img photo']):"");
            ?> 
        </div><!--img-->
        </div>
    
        <div class="col-sm-10">
    <?= $form->field($model, 'school_title')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, 'school_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'school_village')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'school_mu')->textInput() ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'school_road')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <?=
            $form->field($model, "province_id")->dropdownList(
                    ArrayHelper::map(TbProvince::find()->all(), 'province_id', 'province_name'), [
                'id' => "ddl-province",
                'prompt' => 'เลือกจังหวัด'
            ]);
            ?>
        </div>
        <div class="col-sm-4">
            <?=
            $form->field($model, "amphur_id")->widget(DepDrop::classname(), [
                'options' => ['id' => "ddl-amphur"],
                'data' => $listAmphur,
                'pluginOptions' => [
                    'depends' => ["ddl-province"],
                    'placeholder' => 'เลือกอำเภอ...',
                    'url' => Url::to(['address/get-amphur'])
                ]
            ]);
            ?>
        </div>
        <div class="col-sm-4">
            <?=
            $form->field($model, "tambol_id")->widget(DepDrop::classname(), [
                'data' => $listTambol,
                'pluginOptions' => [
                    'depends' => ["ddl-province", "ddl-amphur"],
                    'placeholder' => 'เลือกตำบล...',
                    'url' => Url::to(['address/get-tambol'])
                ]
            ]);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'school_type')->dropDownList(['1'=>'โรงเรียน','หน่วยงาน']) ?>
        </div>
    </div>                     


    <div class="row">
        <!--        <div class="col-sm-3">
        <?= $form->field($model, 'degree_id')->textInput() ?>
        </div>-->
        <div class="col-sm-3">
            <?=
            $form->field($model, 'school_level_id')->checkboxList($listSchoolLevel);
            ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'school_category')->dropDownList(TbSchool::itemsAlias('school_category'), ['prompt' => Yii::t('app', 'เลือก')]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'school_size')->dropDownList(TbSchool::itemsAlias('school_size'), ['prompt' => Yii::t('app', 'เลือก')]) ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'school_number_staff')->textInput() ?>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'school_detail')->widget(CKEditor::className(), [
        'options' => ['rows' =>50],
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
        </div>

    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('person', 'Create') : Yii::t('person', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

     </div>
    </div>        
            
    <?php ActiveForm::end(); ?>

</div>


<?php
$this->registerJs(' 
    $(".photo").click(function(e) {        
            $("#modal-img").modal("show");        
    });
    
    $("input[name=\'TbImages[img_name_file]\']").on("fileuploaded", function(event, data, previewId, index) {
        console.log("File batch upload complete "+data.response.img_id);
        //data.response.files
        $("#tbschool-img_id").val(data.response.img_id);
        $("img.img_id").attr("src",data.response.src);
        $("#modal-img").modal("hide");
    });  
    

');

Modal::begin(['id' => 'modal-img']);
$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
?>
<?=
$form->field(new \backend\modules\slide\models\TbImages, 'img_name_file')->widget(FileInput::classname(), [
    //'options' => ['accept' => 'image/*'],
    'pluginOptions' => [
        'showCaption' => false,
        'showRemove' => false,
        'showUpload' => true,
        'uploadUrl' => Url::to([ '/persons/school/img']),
        'showPreview' => true,
        'browseClass' => 'btn btn-primary',
        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
        'browseLabel' => 'Select Photo'
    ],
    'options' => ['accept' => 'image/*', 'id' => 'img_name_file']
]);
?>