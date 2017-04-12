<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\system\modules\menu\models\SysMenuCategory;
/* @var $this yii\web\View */
/* @var $model app\modules\system\modules\menu\models\SysMenuCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sys-menu-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'menu_cate_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'menu_cate_status')->dropDownList(SysMenuCategory::itemsAlias('status'), ['prompt' =>Yii::t('app','เลือก')]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
