<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use kartik\widgets\Select2;
use yii\helpers\Url;

###############################

use backend\modules\persons\models\teach\TbSubject;
$listSubject = ArrayHelper::map(TbSubject::find()->all(), 'subject_id', 'subject_title');

use backend\modules\persons\models\teach\TbEduClass;
$listEduClass = ArrayHelper::map(TbEduClass::find()->all(), 'edu_class_id', 'edu_class_title');
?>
   <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <?= Html::tag('h4', Yii::t('person', 'ด้านการสอน')) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5 col-sm-offset-2">
            
            <?=
            $form->field($modelTeach, 'subject_id', [])->widget(Select2::classname(), [
                'data' => $listSubject,
                'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                'pluginOptions' => [
                    'allowClear' => true,
                    'tags' => true,
                ],
            ])->hint(Yii::t('person','Please complete press enter'));
            ?>
        </div> 
        <div class="col-sm-3">
            <?=
            $form->field($modelTeach, 'edu_class_id', [])->widget(Select2::classname(), [
                'data' => $listEduClass,
                'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                'pluginOptions' => [
                    'allowClear' => true,
                    'tags' => true,
                ],
            ])->hint(Yii::t('person','Please complete press enter'));
            ?>
        </div>        
    </div>
