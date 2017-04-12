<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use kartik\widgets\Select2;
use yii\helpers\Url;
####################################
use backend\modules\persons\models\education\TbDegree;
$listDegree = ArrayHelper::map(TbDegree::find()->all(), 'degree_id', 'degree_title');

use backend\modules\persons\models\education\TbMajor;
$listMajor = ArrayHelper::map(TbMajor::find()->all(), 'major_id', 'major_title');

use backend\modules\persons\models\education\TbEduLevel;
$listEduLevel = ArrayHelper::map(TbEduLevel::find()->all(), 'edu_level_id', 'edu_level_title');

use backend\modules\persons\models\education\TbEduLocal;
$listEduLocal = ArrayHelper::map(TbEduLocal::find()->all(), 'edu_local_id', 'edu_local_title');

?>
<?= Html::tag('h4', Yii::t('person', 'Education')) ?>
    <div class="row">
        <div class="col-sm-3 col-sm-offset-2">
<?= $form->field($modelStudy, 'study_year_finish')->widget(MaskedInput::classname(), [
                'name' => 'study_year_finish',
                'mask' => ['9999']
            ])->hint('ปีการศึกษาไทย');
            ?>  
        </div>

        <div class="col-sm-5">
            <?=
            $form->field($modelStudy, 'edu_level_id', [])->widget(Select2::classname(), [
                'data' => $listEduLevel,
                'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                'pluginOptions' => [
                    'allowClear' => true,
                    //'tags' => true,
                ],
            ]);
            ?>
        </div>        
    </div>
    <div class="row">
        <div class="col-sm-4 col-sm-offset-2">
            <?=
            $form->field($modelStudy, 'degree_id', [])->widget(Select2::classname(), [
                'data' => $listDegree,
                'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                'pluginOptions' => [
                    'allowClear' => true,
                    'tags' => true,
                ],
            ])->hint(Yii::t('person','Please complete press enter'));
            ?>
        </div> 
        <div class="col-sm-4">
            <?=
            $form->field($modelStudy, 'major_id', [])->widget(Select2::classname(), [
                'data' => $listMajor,
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
            <?=
            $form->field($modelStudy, 'edu_local_id', [])->widget(Select2::classname(), [
                'data' => $listEduLocal,
                'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                'pluginOptions' => [
                    'allowClear' => true,
                    'tags' => true,
                ],
            ])->hint(Yii::t('person','Please complete press enter'));
            ?>
        </div> 
        </div> 
