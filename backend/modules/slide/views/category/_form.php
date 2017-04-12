<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\slide\models\TbSlideCategory */
/* @var $form yii\widgets\ActiveForm */



?>

<div class="tb-slide-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'slide_cate_title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'slide_cate_width')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'slide_cate_hiegth')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
