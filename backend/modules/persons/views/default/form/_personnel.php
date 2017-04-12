<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\DatePicker;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\teach\TbPersonnel */
/* @var $form yii\widgets\ActiveForm */
use backend\modules\persons\models\teach\TbSchool;

$TbSchool = TbSchool::find()->all();
$listSchool = ArrayHelper::map($TbSchool, 'school_id', 'school_title');

use backend\modules\persons\models\TbPosition;

$TbPosition = TbPosition::find()->all();
$listPosition = ArrayHelper::map($TbPosition, 'position_id', 'position_title');
?>

<div class='box box-info'>
    <?php
    // print_r($modelStudy);
    //exit();
    DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper_personnel', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.personnel-items', // required: css class selector
        'widgetItem' => '.item-personnel', // required: css class
        'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 0, // 0 or 1 (default 1)
        'insertButton' => '.add-item-personnel', // css class
        'deleteButton' => '.remove-item-personnel', // css class
        'model' => $modelPersonnel[0],
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
                <i class="glyphicon glyphicon-envelope"></i> <?= Yii::t('person', 'การบรรจุเป็นบุคลากรด้านการศึกษา') ?>
                <button type="button" class="add-item-personnel btn btn-success btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> เพิ่ม</button>
            </h4>
        </div>
        <div class="panel-body">
            <div class="personnel-items"><!-- widgetBody -->
                 <p><?=Html::a('<i class="fa fa-list"></i> จัดการข้อมูลโรงเรียน',  yii\helpers\Url::to(['/persons/school/']),['class'=>'btn btn-success','target'=>'_blank'])?></p>
                
                <?php
                //print_r($modelPersonnel);
                foreach ($modelPersonnel as $i => $model):

                    if (!$model->isNewRecord) {
                        echo Html::activeHiddenInput($model, "[{$i}]personnel_id");
                    }
                    ?>
                    <div class="item-personnel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">บุคลากรด้านการศึกษา</h3>
                            <div class="pull-right">

                                <button type="button" class="remove-item-personnel btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-sm-2">
                                    <?=
                                    $form->field($model, "[$i]personnel_start")->widget(DatePicker::classname(), [
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
                                <div class="col-sm-2">
                                    <?=
                                    $form->field($model, "[$i]personnel_end")->widget(DatePicker::classname(), [
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
                           
                                <div class="col-sm-4">
                                    <?=
                                    $form->field($model, "[$i]school_id")->widget(Select2::classname(), [
                                        'data' => $listSchool,
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
                                    $form->field($model, "[$i]position_id")->widget(Select2::classname(), [
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

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php DynamicFormWidget::end(); ?>


</div>