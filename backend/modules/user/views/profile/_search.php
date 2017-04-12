<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\TbUserProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-user-profile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'user_idcard') ?>

    <?= $form->field($model, 'user_name') ?>

    <?= $form->field($model, 'user_surname') ?>

    <?= $form->field($model, 'user_nickname') ?>

    <?php // echo $form->field($model, 'antecedent_id') ?>

    <?php // echo $form->field($model, 'user_sex') ?>

    <?php // echo $form->field($model, 'user_data') ?>

    <?php // echo $form->field($model, 'user_img') ?>

    <?php // echo $form->field($model, 'person_id') ?>

    <?php // echo $form->field($model, 'user_phone') ?>

    <?php // echo $form->field($model, 'user_workstation') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('person', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('person', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
