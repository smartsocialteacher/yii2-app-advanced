<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\album\models\TbAlbumCategorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-album-category-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'album_cate_id') ?>

    <?= $form->field($model, 'album_cate_title') ?>

    <?= $form->field($model, 'album_cate_folder') ?>

    <?= $form->field($model, 'album_cate_parent_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
