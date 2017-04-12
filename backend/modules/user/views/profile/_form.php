<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\file\FileInput;
use backend\modules\user\models\TbUserProfile;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\TbUserProfile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-user-profile-form">

    <?php $form = ActiveForm::begin(); ?>

    
    
    <div class="row">
        
        <div class="col-sm-3">
            <div class="img img-thumbnail" style="overflow: hidden;height: 200px;width: 100%;" >
             
<?=
Html::img($model->user_img&&(Yii::$app->img->chkImg(TbUserProfile::PATH_IMG,$model->user_img)) ? Yii::$app->img->getUploadUrl($model->img->img_path_file) . $model->user_img : Yii::$app->img->getNoimg()
        , [
    'width' => '100%',
    'class' => 'user_img',
]);
?>
            
        </div><!--img-->
            
            <?= (!$model->isNewRecord?Html::button('<i class="glyphicon glyphicon-camera"></i>', ['value' => Url::to(['customer/create']), 'title' => Yii::t('person', 'Education'), 'class' => 'btn btn-default modal-img photo']):"");
            ?> 
        </div>
        <div class="col-sm-9">
    
    <?= $form->field($model, 'user_img')->hiddenInput()->label(FALSE); ?>
    <?= $form->field($model, 'user_img_old')->hiddenInput()->label(FALSE); ?>
    <?= $form->field($model, 'user_id')->hiddenInput()->label(FALSE); ?>

    <?= $form->field($model, 'user_idcard')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_nickname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'antecedent_id')->textInput() ?>

    <?= $form->field($model, 'user_sex')->dropDownList([ 'F' => 'F', 'M' => 'M', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'user_data')->textarea(['rows' => 6]) ?>

    

    <?= $form->field($model, 'person_id')->textInput() ?>

    <?= $form->field($model, 'user_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_workstation')->textInput(['maxlength' => true]) ?>

            </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('person', 'Create') : Yii::t('person', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



<?php
$urlImg = Url::to(['/user/default/select-img', 'id' => $model->person_id]);
$this->registerJs(' 
    $(".photo").click(function(e) {       
        $("#modal-img").modal("show");       
    });
    
    $("input[name=\'TbImages[img_name_file]\']").on("fileuploaded", function(event, data, previewId, index) {
        console.log("File batch upload complete "+data.response.img_id);
        //data.response.files
        $("#tbuserprofile-user_img").val(data.response.img_id);
        $("img.user_img").attr("src",data.response.src);
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
        'uploadUrl' => Url::to([ '/user/default/img', "id" => $model->person_id]),
        'showPreview' => true,
        'browseClass' => 'btn btn-primary',
        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
        'browseLabel' => 'Select Photo'
    ],
    'options' => ['accept' => 'image/*', 'id' => 'img_name_file']
]);
?>


<?php
ActiveForm::end();
Modal::end();
?>