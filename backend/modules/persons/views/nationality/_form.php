<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\TbNationality */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-nationality-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nationality_title')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('person', 'Create') : Yii::t('person', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
