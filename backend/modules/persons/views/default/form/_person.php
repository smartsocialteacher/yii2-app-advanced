<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
//use kartik\widgets\ActiveForm;
//use kartik\widgets\ActiveField;
use kartik\widgets\Select2;
use yii\widgets\MaskedInput;
use yii\helpers\ArrayHelper;
use kartik\widgets\DatePicker;
use backend\modules\persons\models\TbAntecedent;

$antecedent = TbAntecedent::find()->all();
$listAntecedent = ArrayHelper::map($antecedent, 'antecedent_id', 'antecedent_title');

use backend\modules\persons\models\TbPersonType;

$PersonType = TbPersonType::find()->all();
$listPersonType = ArrayHelper::map($PersonType, 'person_type_id', 'person_type_title');

use backend\modules\persons\models\TbPosition;

$Position = TbPosition::find()->all();
$listPosition = ArrayHelper::map($Position, 'position_id', 'position_title');

use backend\modules\persons\models\TbRace;

$TbRace = TbRace::find()->all();
$listRace = ArrayHelper::map($TbRace, 'race_id', 'race_title');

use backend\modules\persons\models\TbNationality;

$TbNationality = TbNationality::find()->all();
$listNationality = ArrayHelper::map($TbNationality, 'nationality_id', 'nationality_title');

use backend\modules\persons\models\TbReligion;

$TbReligion = TbReligion::find()->all();
$listReligion = ArrayHelper::map($TbReligion, 'religion_id', 'religion_title');
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4>
            <i class="glyphicon glyphicon-user"></i> <?= Yii::t('person', 'ข้อมูลทั่วไป') ?>               
        </h4>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-4 ">

                <?= $form->field($model, 'person_sex')->radioList($model->getItemSex()) ?>
            </div>
            <div class="col-sm-4 ">
                <?=
                $form->field($model, 'person_birthday')->widget(DatePicker::classname(), [
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
            <div class="col-sm-4 ">    
<?= $form->field($model, 'person_blood_groups')->dropDownList($model->getItemBloodGroups(), ['prompt' => Yii::t('app', 'เลือก')]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 ">   



                <?=
                $form->field($model, 'race_id')->widget(Select2::classname(), [
                    'data' => $listRace,
                    'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'tags' => true,
                    ],
                    'pluginEvents' => [
                        "select" => "function() {console.log('select'); }",
                        "select2-select" => "function() { console.log('select2-select'); }",
                    ]
                ])
        //->hint(Yii::t('person','Please complete press enter'));
                ?>
            </div>
            <div class="col-sm-4 ">
                <?=
                $form->field($model, 'nationality_id')->widget(Select2::classname(), [
                    'data' => $listNationality,
                    'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'tags' => true,
                    ],
                ])
                        //->hint(Yii::t('person','Please complete press enter'));
                ?>
            </div>
            <div class="col-sm-4 ">
                <?=
                $form->field($model, 'religion_id')->widget(Select2::classname(), [
                    'data' => $listReligion,
                    'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'tags' => true,
                    ],
                ])
                        //->hint(Yii::t('person','Please complete press enter'));
                ?>

            </div>
        </div>


        <div class="row">
            <div class="col-sm-4 ">
                <?= $form->field($model, 'person_phone')->widget(MaskedInput::classname(), [
                    'name' => 'person_mobile',
                    'mask' => ['9999999999']
                ]);?>
            </div>
            <div class="col-sm-4 ">
                <?=
                $form->field($model, 'person_mobile')->widget(MaskedInput::classname(), [
                    'name' => 'person_mobile',
                    'mask' => ['9999999999']
                ]);
                ?>
            </div>
            <div class="col-sm-4 ">
<?= $form->field($model, 'person_email')->textInput(['maxlength' => true]) ?>

            </div>
        </div>


    </div>
</div>

<?php if(!$model->isNewRecord){
echo  $this->render('_address', [
                    'modelAddress' => $modelAddress,
                    'form' => $form
                ]);
}
?>