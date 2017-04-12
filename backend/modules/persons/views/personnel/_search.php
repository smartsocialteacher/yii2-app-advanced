<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\teacher\TbPersonnelSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-personnel-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'personnel_start') ?>

    <?= $form->field($model, 'personnel_end') ?>

    <?= $form->field($model, 'person_id') ?>

    <?= $form->field($model, 'school_id') ?>

    <?= $form->field($model, 'position_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('person', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('person', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
