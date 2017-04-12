<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\youtube\models\TbYoutubeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-youtube-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'yt_id') ?>

    <?= $form->field($model, 'yt_vid') ?>

    <?= $form->field($model, 'yt_title') ?>

    <?= $form->field($model, 'yt_description') ?>

    <?= $form->field($model, 'yt_watchURL') ?>

    <?php // echo $form->field($model, 'yt_thumbnailURL') ?>

    <?php // echo $form->field($model, 'yt_viewCount') ?>

    <?php // echo $form->field($model, 'yt_length') ?>

    <?php // echo $form->field($model, 'yt_author') ?>

    <?php // echo $form->field($model, 'yt_date_create') ?>

    <?php // echo $form->field($model, 'yt_published') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('person', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('person', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
