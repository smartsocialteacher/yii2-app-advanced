<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use kartik\widgets\Select2;
/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\teach\TbTeach */
/* @var $form yii\widgets\ActiveForm */
use backend\modules\persons\models\teach\TbTeach;

use backend\modules\persons\models\teach\TbSubject;
$listSubject = ArrayHelper::map(TbSubject::find()->all(), 'subject_id', 'subject_title');

use backend\modules\persons\models\teach\TbEduClass;
$listEduClass = ArrayHelper::map(TbEduClass::find()->all(), 'edu_class_id', 'edu_class_title');

$range = 70;
$year = range(date('Y'), date('Y') - $range);
foreach ($year as $n)
$teach_year[$n] = $n + 543;
?>

<div class="tb-teach-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'teach_year')->widget(Select2::classname(), [
                'data' => $teach_year,
                'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                'pluginOptions' => [
                    'allowClear' => true,
                //'tags' => true,
                ],
            ])->hint('ปีการศึกษาไทย');
            ?>

    <?= $form->field($model, 'teach_term')->dropDownList(TbTeach::itemsAlias('teach_term'), ['prompt' => '']) ?>

    <?= $form->field($model, 'edu_class_id')->widget(Select2::classname(), [
                'data' => $listEduClass,
                'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                'pluginOptions' => [
                    'allowClear' => true,
                'tags' => true,
                ],
            ]);
            ?>
    
    <?= $form->field($model, 'subject_id')->widget(Select2::classname(), [
                'data' => $listSubject,
                'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                'pluginOptions' => [
                    'allowClear' => true,
                'tags' => true,
                ],
            ]);
            ?>
    <?= $form->field($model, 'teach_hoursPweek')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('person', 'Create') : Yii::t('person', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
