<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\articles\models\TbArticleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-article-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'art_id') ?>

    <?= $form->field($model, 'art_cate_id') ?>

    <?= $form->field($model, 'art_title') ?>

    <?= $form->field($model, 'art_access') ?>

    <?= $form->field($model, 'art_published') ?>

    <?php // echo $form->field($model, 'art_intro') ?>

    <?php // echo $form->field($model, 'art_contents') ?>

    <?php // echo $form->field($model, 'art_images') ?>

    <?php // echo $form->field($model, 'art_created') ?>

    <?php // echo $form->field($model, 'art_created_by') ?>

    <?php // echo $form->field($model, 'art_modified') ?>

    <?php // echo $form->field($model, 'art_modified_by') ?>

    <?php // echo $form->field($model, 'language') ?>

    <?php // echo $form->field($model, 'art_start') ?>

    <?php // echo $form->field($model, 'art_finish') ?>

    <?php // echo $form->field($model, 'activity_mode') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
