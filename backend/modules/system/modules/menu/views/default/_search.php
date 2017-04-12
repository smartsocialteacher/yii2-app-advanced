<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\system\modules\menu\models\SysMenuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sys-menu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'menu_id') ?>

    <?= $form->field($model, 'menu_cate_id') ?>

    <?= $form->field($model, 'menu_parent_id') ?>

    <?= $form->field($model, 'menu_title') ?>

    <?= $form->field($model, 'menu_link') ?>

    <?php // echo $form->field($model, 'menu_parameter') ?>

    <?php // echo $form->field($model, 'menu_icon') ?>

    <?php // echo $form->field($model, 'mod_id') ?>

    <?php // echo $form->field($model, 'menu_published') ?>

    <?php // echo $form->field($model, 'menu_access') ?>

    <?php // echo $form->field($model, 'menu_target') ?>

    <?php // echo $form->field($model, 'menu_ptc') ?>

    <?php // echo $form->field($model, 'menu_params') ?>

    <?php // echo $form->field($model, 'menu_home') ?>

    <?php // echo $form->field($model, 'menu_sort') ?>

    <?php // echo $form->field($model, 'language') ?>

    <?php // echo $form->field($model, 'menu_assoc') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
