<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use backend\modules\persons\models\education\TbEduLevel;

$listEduLevel = ArrayHelper::map(TbEduLevel::find()->orderBy(['edu_level_id'=>'ASC'])->all(), 'edu_level_id', 'edu_level_title');

use backend\modules\persons\models\education\TbEduLocal;

$listEduLocal = ArrayHelper::map(TbEduLocal::find()->all(), 'edu_local_id', 'edu_local_title');

use backend\modules\persons\models\education\TbMajor;

$listMajor = ArrayHelper::map(TbMajor::find()->all(), 'major_id', 'major_title');

use backend\modules\persons\models\education\TbDegree;

$listDegree = ArrayHelper::map(TbDegree::find()->all(), 'degree_id', 'degree_title');

$range = 70;
$year = range(date('Y'), date('Y') - $range);
foreach ($year as $n)
    $study_year_finish[$n] = $n + 543;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class='box box-info'>
    <?php
    // print_r($modelsStudy);
    //exit();
    DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.study-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 0, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelsStudy[0],
        'formId' => 'person-form',
        'formFields' => [
            'study_year_finish',
            'edu_level_id',
            'study_toplevel',
            'person_id',
            'edu_local_id',
            'major_id',
            'degree_id',
        ],
    ]);
    ?>


    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                <i class="glyphicon glyphicon-envelope"></i> ประวัติการศึกษา
                <button type="button" class="add-item btn btn-success btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> เพิ่ม</button>
            </h4>
        </div>
        <div class="panel-body">
            <div class="study-items"><!-- widgetBody -->
                <?php
                foreach ($modelsStudy as $i => $model):
                    //$modelStudy->person_id = $modelCustomer->person_id;
                    ?>
                    <div class="item panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">การศึกษา</h3>
                            <div class="pull-right">

                                <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            //necessary for update action.
                            if (!$model->isNewRecord) {
                                echo Html::activeHiddenInput($model, "[{$i}]study_id");
                            }
                            ?>                        


                            <div class="row">                                
                                <div class="col-sm-2">
                                    <?=
                                    $form->field($model, "[{$i}]study_year_finish")->widget(Select2::classname(), [
                                        'data' => $study_year_finish,
                                        'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                        //'tags' => true,
                                        ],
                                    ])->hint('ปีการศึกษาไทย');
                                    ?>
                                </div> 
                                <div class="col-sm-3">
                                    <?=
                                    $form->field($model, "[{$i}]edu_level_id")->widget(Select2::classname(), [
                                        'data' => $listEduLevel,
                                        'options' => [
                                            'placeholder' => Yii::t('app', 'เลือก'),
                                            'style' => ['; display:inline !important']
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                            'tags' => true,
                                        ],
                                    ]);
                                    ?>
                                </div>
                                <div class="col-sm-3">
                                    <?=
                                    $form->field($model, "[{$i}]degree_id")->widget(Select2::classname(), [
                                        'data' => $listDegree,
                                        'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                        'tags' => true,
                                        ],
                                    ])->hint(Yii::t('person', 'Please complete press enter'));
                                    ?>
                                </div>
                                <div class="col-sm-4">
                                    <?=
                                    $form->field($model, "[{$i}]major_id")->widget(Select2::classname(), [
                                        'data' => $listMajor,
                                        'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                            'tags' => true,
                                        ],
                                    ])->hint(Yii::t('person', 'Please complete press enter'));
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <?=
                                    $form->field($model, "[{$i}]edu_local_id")->widget(Select2::classname(), [
                                        'data' => $listEduLocal,
                                        'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                            'tags' => true,
                                        ],
                                    ])->hint(Yii::t('person', 'Please complete press enter'));
                                    ?>
                                </div>
                                <div class="col-sm-4">
                                    <?= $form->field($model, "[{$i}]study_toplevel")->checkbox(['label' => ''])->label('ระบบสูงสุด'); ?>
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
