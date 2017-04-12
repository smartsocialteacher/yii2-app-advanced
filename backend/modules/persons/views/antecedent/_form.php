<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\TbAntecedent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-antecedent-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'antecedent_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'antecedent_title_sort')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'antecedent_title_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'antecedent_title_en_sort')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('person', 'Create') : Yii::t('person', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
