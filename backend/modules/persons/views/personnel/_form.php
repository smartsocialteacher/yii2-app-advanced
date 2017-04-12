<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\teach\TbPersonnel */
/* @var $form yii\widgets\ActiveForm */
use backend\modules\persons\models\teach\TbSchool;
$TbSchool = TbSchool::find()->all();
$listSchool = ArrayHelper::map($TbSchool, 'school_id', 'school_title');

use backend\modules\persons\models\TbPosition;
$TbPosition = TbPosition::find()->all();
$listPosition= ArrayHelper::map($TbPosition, 'position_id', 'position_title');
?>

<div class="tb-personnel-form">

<?php $form = ActiveForm::begin(['enableAjaxValidation' => true,'id' => 'personnelform']); ?>

    <div class="row">
        <div class="col-sm-6">


            <?=
            $form->field($model, 'personnel_start')->widget(DatePicker::classname(), [
                'language' => \Yii::$app->language,
                'value' => date('Y-m-d'),
                'removeButton' => false,
                'pickerButton' => ['icon' => 'calendar'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                ],
            ])
            ?>
        </div>
        <div class="col-sm-6">
            <?=
            $form->field($model, 'personnel_end')->widget(DatePicker::classname(), [
                'language' => \Yii::$app->language,
                'value' => date('Y-m-d'),
                'removeButton' => false,
                'pickerButton' => ['icon' => 'calendar'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                ],
            ])
            ?>
        </div>
    </div>



    <div class="row">
        <div class="col-sm-6">
            <?=
            $form->field($model, 'school_id')->widget(Select2::classname(), [
                'data' => $listSchool,
                'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                'pluginOptions' => [
                    'allowClear' => true,
                    'tags' => true,
                ],
            ]);
            ?>
        </div>
        <div class="col-sm-6">
            <?=
            $form->field($model, 'position_id')->widget(Select2::classname(), [
                'data' => $listPosition,
                'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                'pluginOptions' => [
                    'allowClear' => true,
                    'tags' => true,
                ],
            ]);
            ?>
        </div>
    </div>

    
    
    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? Yii::t('person', 'Create') : Yii::t('person', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
