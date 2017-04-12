<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use kartik\widgets\Select2;
/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\teach\TbTeach */
/* @var $form yii\widgets\ActiveForm */
use backend\modules\persons\models\teacher\TbClassTeacher;

use backend\modules\persons\models\teach\TbEduClass;
$listEduClass = ArrayHelper::map(TbEduClass::find()->all(), 'edu_class_id', 'edu_class_title');

$range = 70;
$year = range(date('Y'), date('Y') - $range);
foreach ($year as $n)
    $class_year[$n] = $n + 543;
?>

<div class="tb-class-teacher-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-3">
            <?=
            $form->field($model, 'class_year')->widget(Select2::classname(), [
                'data' => $class_year,
                'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                'pluginOptions' => [
                    'allowClear' => true,
                //'tags' => true,
                ],
            ])->hint('ปีการศึกษาไทย');
            ?>
        </div>
        <div class="col-sm-3">
<?= $form->field($model, 'class_term')->dropDownList(TbClassTeacher::itemsAlias('class_term'), ['prompt' => '']) ?>
        </div>
        <div class="col-sm-3">   
            <?= $form->field($model, 'edu_class_id')->widget(Select2::classname(), [
                'data' => $listEduClass,
                'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                'pluginOptions' => [
                    'allowClear' => true,
                'tags' => true,
                ],
            ]);
            ?>
        </div>
        <div class="col-sm-3">
<?= $form->field($model, 'class_room')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
<?= $form->field($model, 'class_note')->textInput(['maxlength' => true]) ?>



    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? Yii::t('person', 'Create') : Yii::t('person', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
