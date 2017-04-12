<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\TbAntecedentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-antecedent-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'antecedent_id') ?>

    <?= $form->field($model, 'antecedent_title') ?>

    <?= $form->field($model, 'antecedent_title_sort') ?>

    <?= $form->field($model, 'antecedent_title_en') ?>

    <?= $form->field($model, 'antecedent_title_en_sort') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('person', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('person', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
