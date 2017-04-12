<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\education\TbStudy */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-study-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, 'study_year_finish')->textInput(['maxlength' => true]) ?>
       </div>
        <div class="col-sm-4">
    <?= $form->field($model, 'edu_level_id')->textInput() ?>
            </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'edu_local_id')->textInput() ?>
        </div>
    </div>
   

    

    <?= $form->field($model, 'major_id')->textInput() ?>

    <?= $form->field($model, 'degree_id')->textInput() ?>
    
    
 <?= $form->field($model, 'study_toplevel')->dropDownList([ 1 => '1', 0 => '0',], ['prompt' => '']) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('person', 'Create') : Yii::t('person', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary' 
           //,'data-dismiss'=>'modal'
            ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
