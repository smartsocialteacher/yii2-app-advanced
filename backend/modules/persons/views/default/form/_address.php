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

use yii\widgets\MaskedInput;




?>


    <?php foreach ($modelAddress as $key=>$model):
    $listAmphur = ArrayHelper::map(TbAddress::itemAmphurList($model->province_id),'amphur_id','amphur_name');
    $listTambol = ArrayHelper::map(TbAddress::itemTambolList($model->amphur_id),'tambol_id','tambol_name');
    if (!$model->isNewRecord) {
        echo Html::activeHiddenInput($model, "[$key]address_id");
        //echo Html::activeHiddenInput($model, "[$key]address_on");
    }
        echo $form->field($model, "[$key]address_on")->hiddenInput(['value' => $model->address_on])->label(false);
        ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4>
            <i class="glyphicon glyphicon-home"></i> <?= $model->addressOn?>               
        </h4>
    </div>
    <div class="panel-body">
    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, "[$key]address_no")->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, "[$key]address_village")->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-1">
            <?= $form->field($model, "[$key]address_mu")->textInput() ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model, "[$key]address_road")->textInput(['maxlength' => true]) ?>
        </div></div>
    <div class="row">
        <div class="col-sm-4">
            <?=
            $form->field($model, "[$key]province_id")->dropdownList(
                    ArrayHelper::map(TbProvince::find()->all(), 'province_id', 'province_name'), [
                'id' => "ddl-province$key",
                'prompt' => 'เลือกจังหวัด'
            ]);
            ?>
        </div>
        <div class="col-sm-4">
            <?=
            $form->field($model, "[$key]amphur_id")->widget(DepDrop::classname(), [
                'options' => ['id' => "ddl-amphur$key"],
                'data' => $listAmphur,
                'pluginOptions' => [
                    'depends' => ["ddl-province$key"],
                    'placeholder' => 'เลือกอำเภอ...',
                    'url' => Url::to(['address/get-amphur'])
                ]
            ]);
            ?>
        </div>
        <div class="col-sm-4">
            <?= 
            $form->field($model, "[$key]tambol_id")->widget(DepDrop::classname(), [
                'data' => $listTambol,
                'pluginOptions' => [
                    'depends' => ["ddl-province$key", "ddl-amphur$key"],
                    'placeholder' => 'เลือกตำบล...',
                    'url' => Url::to(['address/get-tambol'])
                ]
            ]);
            ?>
        </div></div>
    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, "[$key]address_zip_code")->widget(MaskedInput::classname(), [
                    'name' => "[$key]address_zip_code",
                    'mask' => ['99999']
                ]);?>
        </div>
    </div>  
    </div>
    </div>
<?php  endforeach;?>


