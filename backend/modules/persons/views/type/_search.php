<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\TbPersonTypeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-person-type-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'person_type_id') ?>

    <?= $form->field($model, 'person_type_title') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('person', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('person', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
