<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use kartik\widgets\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\bootstrap\Modal;
use app\widgets\CKEditor;
/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\teach\TbTeach */
/* @var $form yii\widgets\ActiveForm */
use backend\modules\persons\models\activity\TbActivity;

$listActivity = ArrayHelper::map(TbActivity::find()->all(), 'activity_id', 'activity_title');

use backend\modules\persons\models\activity\TbActivityJoin;

$listActivityMode = TbActivityJoin::itemsAlias('activity_mode');

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
        'widgetContainer' => 'dynamicform_wrapper_activity', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.activity-items', // required: css class selector
        'widgetItem' => '.item-activity', // required: css class
        'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 0, // 0 or 1 (default 1)
        'insertButton' => '.add-item-activity', // css class
        'deleteButton' => '.remove-item-activity', // css class
        'model' => $modelsActivityJoin[0],
        'formId' => 'person-form',
        'formFields' => [
            'activity_id',
        ],
    ]);
    ?>


    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                <i class="glyphicon glyphicon-envelope"></i> <?= Yii::t('person', 'Activity') ?>

<!--                <button type="button" class="activity-create-link btn btn-success btn-sm"><i class="glyphicon glyphicon-plus"></i> เพิ่มกิจกรรม</button>-->
                <button type="button" class="add-item-activity btn btn-success btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> เพิ่ม</button>
            </h4>
        </div>
        <div class="panel-body">
            <div class="activity-items"><!-- widgetBody -->
                 <p><?=Html::a('<i class="fa fa-list"></i> จัดการข้อมูลฝึกอบรม/สัมมนา',  yii\helpers\Url::to(['/persons/activity']),['class'=>'btn btn-success','target'=>'_blank'])?></p>
                <?php
                //print_r($modelPersonnel);
                foreach ($modelsActivityJoin as $i => $model):
                    // echo $form->field($model, "[{$i}]person_id")->hiddenInput(['value' => $modelPerson->person_id])->label(false);
                    ?>
                    <div class="item-activity panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left"><?=Yii::t('person', 'อบรม / สัมมนา')?></h3>
                            <div class="pull-right">

                                <button type="button" class="remove-item-activity btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-sm-10"> 
                                    <?=
                                    $form->field($model, "[{$i}]activity_id", ['enableAjaxValidation' => true])->widget(Select2::classname(), [
                                        // 'initValueText' => $cityDesc, // set the initial display text
                                        'data' => $listActivity,
                                        'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                            'minimumInputLength' => 2,
                                            'ajax' => [
                                                'url' => Url::to(['/persons/activity/activity-list']),
                                                'dataType' => 'json',
                                                'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                            ],
                                            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                            'templateResult' => new JsExpression('function(city) { return city.text; }'),
                                            'templateSelection' => new JsExpression('function (city) { return city.text; }'),
                                        ],
                                    ]);
                                    ?>




                                </div>
                                <div class="row">
                                    <div class="col-sm-2"> 
                                        <?= $form->field($model, "[{$i}]person_mode", ['enableAjaxValidation' => true])->dropDownList($model->getItemPersonMode(), ['prompt' => Yii::t('app', 'เลือก')]) ?>
                                    </div>

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
<?php
Modal::begin([
    'id' => 'activity-modal',
    'header' => '<h4 class="modal-title">#</h4>',
    'size' => 'modal-lg',
        //'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">ปิด</a>',
]);
// echo $this->render('../../activity/_form',['model'=>new TbActivity()]);
Modal::end();
?>


<?php



$urlCreate = Url::to(['/persons/activity/create-ajax-tab', 'id' => $modelPerson->person_id]);

$script = <<< JS
var activity_form =$('form#activity_form').on('beforeSubmit',function(e)
{
        var \$form =$(this);
        $.post(
            \$form.attr("action","{$urlCreate}"),
            \$form.serialize()
        ).done(function(result){
            if(result.msg=='success'){
        
            }else{
        
            }
        $("#activity-modal").modal("hide");
        }).fail();
   
});

JS;
$this->registerJs($script);
$this->registerJs('
            $.get(
                "' . $urlCreate . '",
                function (data){
                     $("#activity-modal .modal-body").html(data);
                }
           );
            $(".activity-create-link").click(function(e) {
                //alert(55);
                    $.get(
                        "' . $urlCreate . '",
                        function (data)
                        {
                            $("#activity-modal").find(".modal-body").html(data);
                            $("#activity-modal .modal-body").html(data);
                            $("#activity-modal .modal-title").html("เพิ่มข้อมูล");
                            $("#activity-modal").modal("show");
                            CKEDITOR.replace("TbActivity[activity_detail]");
                            activity_form;
                        }
                    );
                });');
?>