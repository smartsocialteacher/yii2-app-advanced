<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\articles\models\TbArticleCategorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-article-category-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'art_cate_id') ?>

    <?= $form->field($model, 'art_cate_title') ?>

    <?= $form->field($model, 'art_cate_intro') ?>

    <?= $form->field($model, 'art_cate_created') ?>

    <?= $form->field($model, 'art_cate_created_by') ?>

    <?php // echo $form->field($model, 'art_cate_parent_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
