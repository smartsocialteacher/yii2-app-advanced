<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\TbUserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'password') ?>

    <?= $form->field($model, 'auth_key') ?>

    <?php // echo $form->field($model, 'displayname') ?>

    <?php // echo $form->field($model, 'user_timecreate') ?>

    <?php // echo $form->field($model, 'timestamp') ?>

    <?php // echo $form->field($model, 'user_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
