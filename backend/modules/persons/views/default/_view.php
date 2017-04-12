<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\Select2;
use yii\widgets\MaskedInput;
use yii\helpers\ArrayHelper;
use kartik\tabs\TabsX;
use yii\bootstrap\Modal;
use kartik\file\FileInput;
use backend\modules\persons\models\TbAntecedent;

$antecedent = TbAntecedent::find()->all();
$listAntecedent = ArrayHelper::map($antecedent, 'antecedent_id', 'antecedent_title');

use backend\modules\persons\models\TbPersonType;

$PersonType = TbPersonType::find()->all();
$listPersonType = ArrayHelper::map($PersonType, 'person_type_id', 'person_type_title');

use backend\modules\persons\models\TbPosition;

$Position = TbPosition::find()->all();
$listPosition = ArrayHelper::map($Position, 'position_id', 'position_title');

$form = ActiveForm::begin(['id' => 'person-form']);
echo $form->field($modelPerson, "img_id")->hiddenInput(['value'=> $modelPerson->img_id])->label(false);


$this->registerCss("         
.img{
    position:relative;
}
.img .modal-img{
position:absolute;
bottom:10px;
right:15px;
z-index:99px;
}
");
?>
<div class="row">
    <div class="col-sm-2">
        <div class="img img-thumbnail" style="overflow: hidden;height: 200px;width: 100%;" >
<?=
Html::img(
        ($modelPerson->img_id) ? Yii::$app->img->getUploadUrl($modelPerson->img->img_path_file) . $modelPerson->img_id : Yii::$app->img->getNoimg()
        , [
    'width' => '100%',
    'class' => 'img_id',
]);
?>
            <?= (!$modelPerson->isNewRecord?Html::button('<i class="glyphicon glyphicon-camera"></i>', ['value' => Url::to(['customer/create']), 'title' => Yii::t('person', 'Education'), 'class' => 'btn btn-default modal-img photo']):"");
            ?> 
        </div><!--img-->
    </div>
    <div class="col-sm-10">
        <div class="row">
            <div class="col-sm-4">
<?=
$form->field($modelPerson, 'person_id_card', ['enableAjaxValidation' => true])->widget(MaskedInput::classname(), [
    'name' => 'person_id_card',
    'mask' => ['9-9999-99999-99-9']
]);
?>
            </div>     
        </div>
        <div class="row">
            <div class="col-sm-4">


<?= $form->field($modelPerson, 'person_type_id')->dropDownList($listPersonType, ['prompt' => Yii::t('app', 'เลือก')]); ?>
            </div> 
            <div class="col-sm-4">
<?= $form->field($modelPerson, 'position_id')->dropDownList($listPosition, ['prompt' => Yii::t('app', 'เลือก')]); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-2">
<?= $form->field($modelPerson, 'antecedent_id', [])->dropDownList($listAntecedent, ['prompt' => Yii::t('app', 'เลือก')]); ?>
            </div>
            <div class="col-sm-5">
<?= $form->field($modelPerson, 'person_name', ['enableAjaxValidation' => true])->textInput(['maxlength' => true]); ?>
            </div>
            <div class="col-sm-5">
<?= $form->field($modelPerson, 'person_surname', ['enableAjaxValidation' => true])->textInput(['maxlength' => true]); ?>
            </div>
        </div>

    </div>
</div>



<hr/>
<?php
#item for posion 1-4
$items1 = [
    [
        'label' => '<i class="glyphicon glyphicon-home"></i> ' . Yii::t('person', 'General'),
        'content' => $this->render('form/_person', [
            'model' => $modelPerson, 
            'form' => $form,
            'modelAddress'=>(!$modelPerson->isNewRecord?$modelAddress:''),
                ]),
        'active' => true
    ],
    [
        'label' => '<i class="glyphicon glyphicon-home"></i> ' . Yii::t('person', 'ข้อมูลโรงเรียน'),
        'content' => $modelPerson->isNewRecord ? '' : $this->render('form/_school', [
                    'modelPerson' => $modelPerson,
                    'modelPersonnel' => $modelPersonnel,
                    'form' => $form
                ]),
        'headerOptions' => ['class' => $modelPerson->isNewRecord ? 'disabled' : '']
    ],
    [
        'label' => '<i class="glyphicon glyphicon-blackboard"></i> ' . Yii::t('person', 'Teacher'),
        'content' => $modelPerson->isNewRecord ? '' : $this->render('form/_classTeacher', [
                    'modelPerson' => $modelPerson,
                    'modelsClassTeachers' => $modelsClassTeachers,
                    'form' => $form
                ]),
        'headerOptions' => ['class' => $modelPerson->isNewRecord ? 'disabled' : '']
    ],
    [
        'label' => '<i class="glyphicon glyphicon-pencil"></i> ' . Yii::t('person', 'ด้านการสอน'),
        'content' => $modelPerson->isNewRecord ? '' : $this->render('form/_teach', [
                    'modelPerson' => $modelPerson,
                    'modelsTeach' => $modelsTeach,
                    'form' => $form
                ]),
        'headerOptions' => ['class' => $modelPerson->isNewRecord ? 'disabled' : '']
    ],
    
    [
        'label' => '<i class="glyphicon glyphicon-home"></i> ' . Yii::t('person', 'Education'),
        'content' => $modelPerson->isNewRecord ? '' : $this->render('form/_study', [
                    'modelPerson' => $modelPerson,
                    'modelsStudy' => $modelsStudy,
                    'form' => $form
                ]),
        'headerOptions' => ['class' => $modelPerson->isNewRecord ? 'disabled' : '']
    ],
    [
        'label' => '<i class="glyphicon glyphicon-globe"></i> ' . Yii::t('person', 'Activity'),
        'content' => $modelPerson->isNewRecord ? '' : $this->render('form/_activity', [
                    'modelPerson' => $modelPerson,
                    'modelsActivityJoin' => $modelsActivityJoin,
                    'form' => $form
                ]),
        'headerOptions' => ['class' => $modelPerson->isNewRecord ? 'disabled' : '']
    ],
];
#item for posion 5-6
$items2 = [
    [
        'label' => '<i class="glyphicon glyphicon-user"></i> ' . Yii::t('person', 'General'),
        'content' => $this->render('form/_person', [
            'model' => $modelPerson,
            'form' => $form,
            'modelAddress'=>(!$modelPerson->isNewRecord?$modelAddress:''),
                ]),
        'active' => true
    ],
//    [
//        'label' => '<i class="glyphicon glyphicon-home"></i> ' . Yii::t('person', 'Address'),
//        'content' => $modelPerson->isNewRecord ? '' : $this->render('form/_address', [
//                    'modelAddress' => $modelAddress,
//                    'form' => $form
//                ]),
//        'headerOptions' => ['class' => $modelPerson->isNewRecord ? 'disabled' : '']
//    ],
    [
        'label' => '<i class="glyphicon glyphicon-education"></i> ' . Yii::t('person', 'Education'),
        'content' => $modelPerson->isNewRecord ? '' : $this->render('form/_study', [
                    'modelPerson' => $modelPerson,
                    'modelsStudy' => $modelsStudy,
                    'form' => $form
                ]),
        'headerOptions' => ['class' => $modelPerson->isNewRecord ? 'disabled' : '']
    ],
    [
        'label' => '<i class="glyphicon glyphicon-tower"></i> ' . Yii::t('person', 'Performance'),
        'content' => $modelPerson->isNewRecord ? '' : $this->render('form/_personnel', [
                    'modelPerson' => $modelPerson,
                    'modelPersonnel' => $modelPersonnel,
                    'form' => $form
                ]),
        'headerOptions' => ['class' => $modelPerson->isNewRecord ? 'disabled' : '']
    ],
    [
        'label' => '<i class="glyphicon glyphicon-blackboard"></i> ' . Yii::t('person', 'Teacher'),
        'content' => $modelPerson->isNewRecord ? '' : $this->render('form/_classTeacher', [
                    'modelPerson' => $modelPerson,
                    'modelsClassTeachers' => $modelsClassTeachers,
                    'form' => $form
                ]),
        'headerOptions' => ['class' => $modelPerson->isNewRecord ? 'disabled' : '']
    ],
    [
        'label' => '<i class="glyphicon glyphicon-pencil"></i> ' . Yii::t('person', 'ด้านการสอน'),
        'content' => $modelPerson->isNewRecord ? '' : $this->render('form/_teach', [
                    'modelPerson' => $modelPerson,
                    'modelsTeach' => $modelsTeach,
                    'form' => $form
                ]),
        'headerOptions' => ['class' => $modelPerson->isNewRecord ? 'disabled' : '']
    ],
    [
        'label' => '<i class="glyphicon glyphicon-globe"></i> ' . Yii::t('person', 'Activity'),
        'content' => $modelPerson->isNewRecord ? '' : $this->render('form/_activity', [
                    'modelPerson' => $modelPerson,
                    'modelsActivityJoin' => $modelsActivityJoin,
                    'form' => $form
                ]),
        'headerOptions' => ['class' => $modelPerson->isNewRecord ? 'disabled' : '']
    ],
];

$items = ($modelPerson->position_id <= 4) ? $items1 : $items2;


echo TabsX::widget([
    'items' => $items,
    'position' => TabsX::POS_ABOVE,
    'bordered' => true,
    'encodeLabels' => false
]);
?>
<br />

        <div class="form-group">
        <?php if($modelPerson->isNewRecord){?>
            <?= Html::Button('<i class="fa fa-save"></i> '.Yii::t('app', 'Create') , 
    [
        'class' => 'btn btn-success btn-lg',
        'type'=>'submit',
        'name'=>'create',
        'value'=>'1'
    ]) ?>
            
            
        <?php }else{ ?>
<?= Html::Button('<i class="fa fa-save"></i> '.Yii::t('app', 'Save') , 
    [
        'class' => 'btn btn-success btn-lg',
        'type'=>'submit',
        'name'=>'save',
        'value'=>'1'
    ]) ?>
            &nbsp;
            &nbsp;
 <?= Html::Button('<i class="fa fa-sign-out"></i> '.Yii::t('app', 'Save & Close') , 
    [
        'class' => 'btn btn-primary btn-lg',
        'type'=>'submit',
        'name'=>'saveClose',
        'value'=>'1'
    ]) ?>
        <?php } ?>
 <?= Html::a('<i class="fa fa-sign-out"></i> '.Yii::t('app', 'Cancel') ,
    Url::to(['/persons/']), 
    [
        'class' => ' btn-lg pull-right',
    ]) ?>
        </div>
<?php ActiveForm::end(); ?>


<?php
$urlImg = Url::to(['/persons/default/select-img', 'id' => $modelPerson->person_id]);
$this->registerJs(' 
    $(".photo").click(function(e) {
        //alert(55);        
        var id="'.$modelPerson->person_id.'";
        if(id){
            $("#modal-img").modal("show");
        }else{
            alert("กรุณาป้อนข้อมูลเบื้องแล้วบันทึก");
        }
    });
    
    $("input[name=\'TbImages[img_name_file]\']").on("filebatchuploadcomplete", function(event, files, extra) {
        console.log("File batch upload complete"+files);
        loadImg();
        $("#modal-img").modal("hide");
    });
    
    var loadImg = function(){
    
        $.get(
            "' . $urlImg . '",
            function (data)
            {                
                //console.log(data.src);
                 $("img.img_id").attr("src",data.src);
            },"json"
        );

       

    }

');

Modal::begin(['id' => 'modal-img']);
$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
?>
<?=
$form->field(new \app\modules\slide\models\TbImages, 'img_name_file')->widget(FileInput::classname(), [
    //'options' => ['accept' => 'image/*'],
    'pluginOptions' => [
        'showCaption' => false,
        'showRemove' => false,
        'showUpload' => true,
        'uploadUrl' => Url::to([ '/persons/default/img', "id" => $modelPerson->person_id]),
        'showPreview' => true,
        'browseClass' => 'btn btn-primary',
        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
        'browseLabel' => 'Select Photo'
    ],
    'options' => ['accept' => 'image/*', 'id' => 'img_name_file']
]);
?>


<?php
ActiveForm::end();
Modal::end();
