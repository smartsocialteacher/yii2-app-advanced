<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\activity\TbActivitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-activity-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'activity_id') ?>

    <?= $form->field($model, 'activity_title') ?>

    <?= $form->field($model, 'activity_detail') ?>

    <?= $form->field($model, 'activity_start') ?>

    <?= $form->field($model, 'activity_end') ?>

    <?php // echo $form->field($model, 'location_id') ?>

    <?php // echo $form->field($model, 'activity_cate_id') ?>

    <?php // echo $form->field($model, 'activity_status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('person', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('person', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
