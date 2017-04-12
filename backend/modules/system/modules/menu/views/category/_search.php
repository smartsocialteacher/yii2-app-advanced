<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\system\modules\menu\models\SysMenuCategorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sys-menu-category-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'menu_cate_id') ?>

    <?= $form->field($model, 'menu_cate_title') ?>

    <?= $form->field($model, 'menu_cate_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
