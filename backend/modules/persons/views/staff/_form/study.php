<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;

use backend\modules\persons\models\education\TbEduLevel;
$TbEduLevel = TbEduLevel::find()->all();
$listEduLevel = ArrayHelper::map($TbEduLevel, 'edu_level_id', 'edu_level_title');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div class='box box-info'>
 <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?php
    DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $model[0],
        'formId' => 'dynamic-form',
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
            <div class="container-items"><!-- widgetBody -->
                <?php
                foreach ($model as $i => $modelStudy):
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
                            // necessary for update action.
//                            if (!$modelStudy->isNewRecord) {
//                                echo Html::activeHiddenInput($modelStudy, "[{$i}]study_id");
//                            }
                            ?>                        
                            
                            
                            <div class="row">                                
                                <div class="col-sm-2">
                                    <?= $form->field($modelStudy, "[{$i}]study_year_finish")->textInput() ?>
                                </div> 
                                <div class="col-sm-3">
                                    <?= $form->field($modelStudy, "[{$i}]edu_level_id")->widget(Select2::classname(), [
                'data' => $listEduLevel,
                'options' => [
                    'placeholder' => Yii::t('app', 'เลือก'),
                    'style'=>['; display:inline !important']
                    ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'tags' => true,
                ],
            ]);
            ?>
                                </div>
                                <div class="col-sm-3">
                                    <?= $form->field($modelStudy, "[{$i}]degree_id")->textInput() ?>
                                </div>
                                <div class="col-sm-4">
                                    <?= $form->field($modelStudy, "[{$i}]major_id")->textInput() ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <?= $form->field($modelStudy, "[{$i}]edu_local_id")->textInput() ?>
                                </div>
                                <div class="col-sm-4">
                                    <?= $form->field($modelStudy, "[{$i}]study_toplevel")->checkbox(['label'=>''])->label('ระบบสูงสุด'); ?>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php DynamicFormWidget::end(); ?>
    
    
        <div class='box-footer'>
<?php
echo Html::beginTag('div', ['class' => 'form-row buttons']);
echo Html::submitButton('Next', ['class' => 'button', 'name' => 'next', 'value' => 'next']);
echo Html::submitButton('Pause', ['class' => 'button', 'name' => 'pause', 'value' => 'pause']);
echo Html::submitButton('Cancel', ['class' => 'button', 'name' => 'cancel', 'value' => 'pause']);
echo Html::endTag('div');
?>
</div><!--box-footer -->
    <?php ActiveForm::end(); ?>

</div>


<?php
echo $this->registerJs(' 
        
$(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
    console.log("beforeInsert");
});

$(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    console.log("afterInsert");
});

$(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
    if (! confirm("Are you sure you want to delete this item?")) {
        return false;
    }
    return true;
});

$(".dynamicform_wrapper").on("afterDelete", function(e) {
    console.log("Deleted item!");
});

$(".dynamicform_wrapper").on("limitReached", function(e, item) {
    alert("Limit reached");
});
        
        
         ');
