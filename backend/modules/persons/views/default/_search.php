<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\TbPersonSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-person-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'person_id') ?>

    <?= $form->field($model, 'person_id_card') ?>

    <?= $form->field($model, 'antecedent_id') ?>

    <?= $form->field($model, 'person_name') ?>

    <?= $form->field($model, 'person_surname') ?>

    <?php // echo $form->field($model, 'person_sex') ?>

    <?php // echo $form->field($model, 'person_birthday') ?>

    <?php // echo $form->field($model, 'person_blood_groups') ?>

    <?php // echo $form->field($model, 'person_phone') ?>

    <?php // echo $form->field($model, 'person_mobile') ?>

    <?php // echo $form->field($model, 'person_email') ?>

    <?php // echo $form->field($model, 'position_id') ?>

    <?php // echo $form->field($model, 'person_type_id') ?>

    <?php // echo $form->field($model, 'race_id') ?>

    <?php // echo $form->field($model, 'nationality_id') ?>

    <?php // echo $form->field($model, 'religion_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('person', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('person', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
