<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\TbAddressSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-address-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'address_id') ?>

    <?= $form->field($model, 'address_no') ?>

    <?= $form->field($model, 'address_village') ?>

    <?= $form->field($model, 'address_mu') ?>

    <?= $form->field($model, 'address_road') ?>

    <?php // echo $form->field($model, 'tambol_id') ?>

    <?php // echo $form->field($model, 'amphur_id') ?>

    <?php // echo $form->field($model, 'province_id') ?>

    <?php // echo $form->field($model, 'address_zip_code') ?>

    <?php // echo $form->field($model, 'address_on') ?>

    <?php // echo $form->field($model, 'person_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('person', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('person', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
