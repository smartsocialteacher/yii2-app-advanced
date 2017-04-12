<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\slide\models\TbSlideSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-slide-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'slide_id') ?>

    <?= $form->field($model, 'slide_cate_id') ?>

    <?= $form->field($model, 'slide_title') ?>

    <?= $form->field($model, 'img_id') ?>

    <?= $form->field($model, 'slide_link') ?>

    <?php // echo $form->field($model, 'slide_date_create') ?>

    <?php // echo $form->field($model, 'slide_published') ?>

    <?php // echo $form->field($model, 'slide_sort') ?>

    <?php // echo $form->field($model, 'slide_start') ?>

    <?php // echo $form->field($model, 'slide_end') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
