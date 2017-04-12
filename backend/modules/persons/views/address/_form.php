<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\TbAddress */
/* @var $form yii\widgets\ActiveForm */
use backend\modules\persons\models\address\TbProvince;
//$TbSchool = TbSchool::find()->all();
//$listSchool = ArrayHelper::map($TbSchool, 'school_id', 'school_title');
use backend\modules\persons\models\address\TbAmphur;
use backend\modules\persons\models\address\TbTambol;
use backend\modules\persons\models\TbAddress;
?>

<div class="tb-address-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'address_on')->dropDownList(TbAddress::itemsAlias('address_on'), ['prompt' => '','disabled'=>'disabled']) ?>
    
    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, 'address_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'address_village')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-1">
            <?= $form->field($model, 'address_mu')->textInput() ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model, 'address_road')->textInput(['maxlength' => true]) ?>
        </div></div>



    <div class="row">
        <div class="col-sm-4">
            <?=
            $form->field($model, 'province_id')->dropdownList(
                    ArrayHelper::map(TbProvince::find()->all(), 'province_id', 'province_name'), [
                'id' => 'ddl-province',
                'prompt' => 'เลือกจังหวัด'
            ]);
            ?>
        </div>
        <div class="col-sm-4">
            <?=
            $form->field($model, 'amphur_id')->widget(DepDrop::classname(), [
                'options' => ['id' => 'ddl-amphur'],
                'data' => $amphur,
                'pluginOptions' => [
                    'depends' => ['ddl-province'],
                    'placeholder' => 'เลือกอำเภอ...',
                    'url' => Url::to(['get-amphur'])
                ]
            ]);
            ?>
        </div>
        <div class="col-sm-4">
            <?=
            $form->field($model, 'tambol_id')->widget(DepDrop::classname(), [
                'data' => $tambol,
                'pluginOptions' => [
                    'depends' => ['ddl-province', 'ddl-amphur'],
                    'placeholder' => 'เลือกตำบล...',
                    'url' => Url::to(['get-tambol'])
                ]
            ]);
            ?>
        </div></div>
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'address_zip_code')->textInput() ?>
        </div>
    </div>
    



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('person', 'Create') : Yii::t('person', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
