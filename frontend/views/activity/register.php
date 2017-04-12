<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\widgets\DatePicker;
use yii\helpers\BaseStringHelper;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use kartik\widgets\Select2;
use yii\helpers\Url;

use backend\modules\persons\models\TbAntecedent;
$antecedent = TbAntecedent::find()->all();
$listAntecedent = ArrayHelper::map($antecedent, 'antecedent_id', 'antecedent_title');








$this->title = Yii::t('person', 'ลงทะเบียน');
$activity_title = BaseStringHelper::truncate($modelAct->activity_title, 70);
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'กิจกรรม/สัมมนา'), 'url' => ['/activity']];
$this->params['breadcrumbs'][] = ['label' => $activity_title, 'url' => ['/activity/view', 'id' => $modelAct->activity_id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="tb-person-form">
<?= Html::tag('h3', Yii::t('person', 'ลงทะเบียน')) ?>
    <div class="well">
<?=Html::tag('h4',$modelAct->activity_title,['class'=>'column-title'])?> 
        
<?=($modelAct->location_id)?Html::tag('small','<i class="fa fa-map-marker"></i> '.$modelAct->location->location_title)."<br />":''?>        
<?=Html::tag('small','<i class="fa fa-clock-o"></i> วันเวลา : '.Yii::$app->formatter->asDateTime($modelAct->activity_start) ." - ".Yii::$app->formatter->asDateTime($modelAct->activity_end)."<br/>").
        Html::a('รายละเอียด',  Url::to(['/activity/view','id'=>$modelAct->activity_id]),['class'=>'btn btn-success'])." ".
        Html::a('ดูรายชื่อ',  Url::to(['/activity/registed','id'=>$modelAct->activity_id]),['class'=>'btn btn-warning'])
         ?>
    </div>
 
    <div class="well">
    <?= Html::tag('h4', Yii::t('person', 'General')) ?>
    <?php $form = ActiveForm::begin([
        'id' => 'contact-form',
        'enableAjaxValidation' => true,
    ]); ?>
    <?php /*= Html::csrfMetaTags()*/ ?>
    <?= Html::activeHiddenInput($modelAct, "activity_id"); ?>
        
<?php /* = Html::activeHiddenInput($modelActivityJoin, "activity_id");?>
  <?= Html::activeHiddenInput($modelActivityJoin, "person_id"); */ ?>

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <?=
            $form->field($model, 'person_id_card'
                    //, ['enableAjaxValidation' => true]
            )->widget(MaskedInput::classname(), [
                'name' => 'person_id_card',
                'mask' => ['9-9999-99999-99-9']
            ]);
            ?>  
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4 col-sm-offset-2">
            <?=
            $form->field($model, 'antecedent_id', [])->widget(Select2::classname(), [
                'data' => $listAntecedent,
                'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                'pluginOptions' => [
                    'allowClear' => true,
                    'tags' => true,
                ],
            ])->hint(Yii::t('person','Please complete press enter'));
            ?>
        </div>
        
    </div>

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
<?= $form->field($model, 'person_name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        
        <div class="col-sm-8 col-sm-offset-2">
<?= $form->field($model, 'person_surname')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">

        <div class="col-sm-2 col-sm-offset-2">
            <?= $form->field($model, 'person_sex')->radioList(backend\modules\persons\models\TbPerson::getItemSex()) ?>
        </div>
        <div class="col-sm-6">
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
    </div>

    <div class="row">

        <div class="col-sm-2 col-sm-offset-2">
            <?=
            $form->field($model, 'person_mobile')->widget(MaskedInput::classname(), [
                'name' => 'person_mobile',
                'mask' => ['9999999999']
            ]);
            ?>
            </div>
        <div class="col-sm-6">
<?= $form->field($model, 'person_email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>



 <!--***** การศึกษา *************************************************************-->
<?=$this->render('_education',[
            'form'=>$form,
            'modelStudy'=>$modelStudy,
        ]);?>


<!--***** การทำงาน *************************************************************-->
<?=$this->render('_personnel',[
            'form'=>$form,
            'modelPersonnel'=>$modelPersonnel
        ]);?>
<!--***** ด้านการสอน *************************************************************-->
 <?=$this->render('_teach',[
            'form'=>$form,
            'modelTeach'=>$modelTeach
         ]); ?>

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">  
            <div class="form-group">
<?= Html::submitButton(Yii::t('person', 'ลงทะเบียน'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>
    </div>

</div>
