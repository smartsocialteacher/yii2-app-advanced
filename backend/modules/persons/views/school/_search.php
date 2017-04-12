<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\teach\TbSchoolSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-school-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'school_id') ?>

    <?= $form->field($model, 'school_title') ?>

    <?= $form->field($model, 'school_no') ?>

    <?= $form->field($model, 'school_village') ?>

    <?= $form->field($model, 'school_mu') ?>

    <?php // echo $form->field($model, 'school_road') ?>

    <?php // echo $form->field($model, 'tambol_id') ?>

    <?php // echo $form->field($model, 'amphur_id') ?>

    <?php // echo $form->field($model, 'province_id') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'fax') ?>

    <?php // echo $form->field($model, 'degree_id') ?>

    <?php // echo $form->field($model, 'school_number_staff') ?>

    <?php // echo $form->field($model, 'school_size') ?>

    <?php // echo $form->field($model, 'school_category') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('person', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('person', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
