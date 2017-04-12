<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
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

$form = ActiveForm::begin();
?>
<div class='box-body pad'>
    <div class="row">
        <div class="col-sm-4">
     <?=
    $form->field($model, 'person_id_card', ['enableAjaxValidation' => true])->widget(MaskedInput::classname(), [
        'name' => 'person_id_card',
        'mask' => ['9-9999-99999-99-9']
    ]);
    ?>
    </div>
        <div class="col-sm-4"> 
            <?=
            $form->field($model, 'person_type_id')->widget(Select2::classname(), [
                'data' => $listPersonType,
                'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                'pluginOptions' => [
                    'allowClear' => true,
                    'tags' => true,
                ],
            ]);
            ?>
        </div>
        <div class="col-sm-4"> 
            <?= $form->field($model, 'position_id')->dropDownList($listPosition, ['prompt' => Yii::t('app', 'เลือก')]) ?>
        </div>
    </div>   
    <div class="row">
        <div class="col-sm-2">
            <?=
            $form->field($model, 'antecedent_id', [])->widget(Select2::classname(), [
                'data' => $listAntecedent,
                'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                'pluginOptions' => [
                    'allowClear' => true,
                    'tags' => true,
                ],
            ]);
//->dropDownList($listAntecedent, ['prompt' => Yii::t('app', 'เลือก')]) 
            ?>
        </div>
        <div class="col-sm-5">    
            <?= $form->field($model, 'person_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model, 'person_surname')->textInput(['maxlength' => true]) ?>
        </div>
    </div>   

    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, 'person_sex')->radioList($model->getItemSex()) ?>
        </div>
        <div class="col-sm-5">  
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
        <div class="col-sm-5">
            <?= $form->field($model, 'person_blood_groups')->dropDownList($model->getItemBloodGroups(), ['prompt' => Yii::t('app', 'เลือก')]) ?>

        </div>
    </div> 

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'race_id')->radioList($listRace); ?>
        </div>
        <div class="col-sm-4">
            <?=
            $form->field($model, 'nationality_id')->widget(Select2::classname(), [
                'data' => $listNationality,
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
            $form->field($model, 'religion_id')->widget(Select2::classname(), [
                'data' => $listReligion,
                'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                'pluginOptions' => [
                    'allowClear' => true,
                    'tags' => true,
                ],
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'person_phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?=
            $form->field($model, 'person_mobile')->widget(MaskedInput::classname(), [
                'name' => 'person_mobile',
                'mask' => ['9999999999']
            ]);
            ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'person_email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

</div><!-- box-body pad-->
<div class='box-footer'>
<?php
echo Html::beginTag('div', ['class' => 'form-row buttons']);
echo Html::submitButton('Next', ['class' => 'button', 'name' => 'next', 'value' => 'next']);
echo Html::submitButton('Pause', ['class' => 'button', 'name' => 'pause', 'value' => 'pause']);
echo Html::submitButton('Cancel', ['class' => 'button', 'name' => 'cancel', 'value' => 'pause']);
echo Html::endTag('div');
?>
</div><!--box-footer -->
 <?php  ActiveForm::end(); ?>
