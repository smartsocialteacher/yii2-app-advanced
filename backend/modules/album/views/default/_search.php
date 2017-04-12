<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\album\models\TbAlbumSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-album-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'album_id') ?>

    <?= $form->field($model, 'album_cate_id') ?>

    <?= $form->field($model, 'album_title') ?>

    <?= $form->field($model, 'album_detail') ?>

    <?= $form->field($model, 'album_path') ?>

    <?php // echo $form->field($model, 'album_image_intro') ?>

    <?php // echo $form->field($model, 'album_date_create') ?>

    <?php // echo $form->field($model, 'album_published') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
