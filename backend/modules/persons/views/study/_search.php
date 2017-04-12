<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\education\TbStudySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-study-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'study_id') ?>

    <?= $form->field($model, 'study_year_finish') ?>

    <?= $form->field($model, 'edu_level_id') ?>

    <?= $form->field($model, 'study_toplevel') ?>

    <?= $form->field($model, 'person_id') ?>

    <?php // echo $form->field($model, 'edu_local_id') ?>

    <?php // echo $form->field($model, 'major_id') ?>

    <?php // echo $form->field($model, 'degree_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('person', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('person', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
