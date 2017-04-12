<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\youtube\models\TbYoutube */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-youtube-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php if($model->isNewRecord){?>
    <?= $form->field($model, 'yt_watchURL')->textInput(['maxlength' => true]) ?>
    <?php }else{ ?>
    <?=Html::img($model->yt_thumbnailURL)?>
    
    
    
    <?= $form->field($model, 'yt_vid')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'yt_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'yt_description')->textarea(['rows' => 6]) ?>

   

    <?= $form->field($model, 'yt_thumbnailURL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'yt_viewCount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'yt_length')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'yt_author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'yt_date_create')->textInput() ?>

    <?= $form->field($model, 'yt_published')->dropDownList([ '0', '1', ], ['prompt' => '']) ?>
    
    <?php } ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('person', 'Create') : Yii::t('person', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
