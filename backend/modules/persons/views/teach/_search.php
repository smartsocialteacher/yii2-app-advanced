<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\teach\TbTeachSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-teach-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'teach_id') ?>

    <?= $form->field($model, 'teach_year') ?>

    <?= $form->field($model, 'teach_term') ?>

    <?= $form->field($model, 'subject_id') ?>

    <?= $form->field($model, 'teach_hoursPweek') ?>

    <?php // echo $form->field($model, 'person_id') ?>

    <?php // echo $form->field($model, 'edu_class_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('person', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('person', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
