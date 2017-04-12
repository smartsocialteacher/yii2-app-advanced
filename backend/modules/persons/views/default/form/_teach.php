<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use kartik\widgets\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
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
<div class='box box-info'>
    <?php
    // print_r($modelStudy);
    //exit();
    DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper_teach', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.teach-items', // required: css class selector
        'widgetItem' => '.item-teach', // required: css class
        'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 0, // 0 or 1 (default 1)
        'insertButton' => '.add-item-teach', // css class
        'deleteButton' => '.remove-item-teach', // css class
        'model' => $modelsTeach[0],
        'formId' => 'person-form',
        'formFields' => [
            'personnel_start',
            'personnel_end',
            'school_id',
            'position_id',
        ],
    ]);
    ?>


    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                <i class="glyphicon glyphicon-envelope"></i> <?= Yii::t('person', 'Performance') ?>
                <button type="button" class="add-item-teach btn btn-success btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> เพิ่ม</button>
            </h4>
        </div>
        <div class="panel-body">
            <div class="teach-items"><!-- widgetBody -->
                <?php
                //print_r($modelPersonnel);
                foreach ($modelsTeach as $i => $model):

                    if (!$model->isNewRecord) {
                        echo Html::activeHiddenInput($model, "[{$i}]teach_id");
                    }
                    ?>
                    <div class="item-teach panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">การสอน</h3>
                            <div class="pull-right">

                                <button type="button" class="remove-item-teach btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-sm-2"> 
                                    <?=
                                    $form->field($model, "[{$i}]teach_year")->widget(Select2::classname(), [
                                        'data' => $teach_year,
                                        'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                        //'tags' => true,
                                        ],
                                    ])->hint('ปีการศึกษาไทย');
                                    ?>
                                </div>
                                <div class="col-sm-2">
                                    <?= $form->field($model, "[{$i}]teach_term")->dropDownList(TbTeach::itemsAlias('teach_term'), ['prompt' => '']) ?>
                                </div>
                                <div class="col-sm-2">
                                    <?=
                                    $form->field($model, "[{$i}]edu_class_id")->widget(Select2::classname(), [
                                        'data' => $listEduClass,
                                        'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                            'tags' => true,
                                        ],
                                    ]);
                                    ?>
                                </div>

                                <div class="col-sm-4">
                                    <?=
                                    $form->field($model, "[{$i}]subject_id")->widget(Select2::classname(), [
                                        'data' => $listSubject,
                                        'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                            'tags' => true,
                                        ],
                                    ])->hint(Yii::t('person', 'Please complete press enter'));
                                    ?>
                                </div>
                                <div class="col-sm-2">
    <?= $form->field($model, "[{$i}]teach_hoursPweek")->textInput() ?>

                                </div>
                            </div>
                        </div>
                    </div>
    <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php DynamicFormWidget::end(); ?>


</div>