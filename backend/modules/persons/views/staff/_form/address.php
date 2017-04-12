<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use kartik\widgets\DepDrop;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\TbAddress */
/* @var $form yii\widgets\ActiveForm */
use backend\modules\persons\models\address\TbProvince;


$listProvince=ArrayHelper::map(TbProvince::find()->all(),'province_id','province_name');
//$listAmphur=ArrayHelper::map(TbProvince::find()->all(),'province_id','province_name');
           
$form = ActiveForm::begin();
?>
<div class='box box-info'>
<?php 
$address_on=['1'=>'ที่อยู่ตามทะเบียนบ้าน','2'=>'ที่อยู่ปัจจุบัน'];
foreach ($address_on as $key => $value): 
    //$model[$key]->address_on=$key;
    ?>

    <div class='box-header'>
        <?= Html::tag('h3',Yii::t('person',$value),['class'=>'box-title']) ?>
    </div><!--box-header -->
    <div class='box-body pad'>
         <?php /*= $form->field($model, "[$key]address_on")->dropDownList($address_on, ['prompt' => '',"readonly"=>true]) */?>
        <?= Html::activeHiddenInput($model, "[{$key}]address_on")?>
    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, "[$key]address_no")->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, "[$key]address_village")->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, "[$key]address_mu")->textInput() ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, "[$key]address_road")->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
    <?= $form->field($model, "[$key]province_id")->dropDownList($listProvince,[
                'id'=>"ddl-province$key",
                'prompt'=>'เลือกจังหวัด'
                ]) ?>
        </div>
        <div class="col-sm-4">
    <?= $form->field($model, "[$key]amphur_id")->widget(DepDrop::classname(), [
            'options'=>['id'=>"ddl-amphur$key"],
            'data'=> [],
            'pluginOptions'=>[
                'depends'=>["ddl-province$key"],
                'placeholder'=>'เลือกอำเภอ...',
                'url'=>Url::to(['address/get-amphur'])
            ]
        ]); ?>
        </div>
        <div class="col-sm-4">
    <?= $form->field($model, "[$key]tambol_id")->widget(DepDrop::classname(), [
            'data'=> [],
            'pluginOptions'=>[
                'depends'=>["ddl-province$key", "ddl-amphur$key"],
                'placeholder'=>'เลือกตำบล...',
                'url'=>Url::to(['address/get-tambol'])
            ]
        ]); ?>
        </div>
        
    </div>
       <div class="row">
        <div class="col-sm-4">
    <?= $form->field($model, "[$key]address_zip_code")->textInput() ?>
        </div>        
    </div>
 </div>

               
        
<?php 
endforeach;  ?>
    <div class='box-footer'>
<?php
echo Html::beginTag('div', ['class' => 'form-row buttons']);
echo Html::submitButton('Next', ['class' => 'button', 'name' => 'next', 'value' => 'next']);
echo Html::submitButton('Pause', ['class' => 'button', 'name' => 'pause', 'value' => 'pause']);
echo Html::submitButton('Cancel', ['class' => 'button', 'name' => 'cancel', 'value' => 'pause']);
echo Html::endTag('div');
?>
</div><!--box-footer -->
    <?php
ActiveForm::end(); 
?>
</div>
