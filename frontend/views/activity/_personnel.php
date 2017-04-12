<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use kartik\widgets\Select2;
use yii\helpers\Url;
################################
use backend\modules\persons\models\teach\TbSchool;
$listSchool = ArrayHelper::map(TbSchool::find()->all(), 'school_id', 'school_title');

use backend\modules\persons\models\TbPosition;
$listPosition = ArrayHelper::map(TbPosition::find()->all(), 'position_id', 'position_title');

?>

<?= Html::tag('h4', Yii::t('person', 'Performance')) ?>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <?= Html::tag('h4', Yii::t('person', 'การบรรจุเป็นบุคลากรด้านการศึกษา')) ?>
        </div>
    </div>
        
    <div class="row">
        <div class="col-sm-5 col-sm-offset-2">
            <?=
            $form->field($modelPersonnel, 'school_id', [])->widget(Select2::classname(), [
                'data' => $listSchool,
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
            $form->field($modelPersonnel, 'position_id', [])->widget(Select2::classname(), [
                'data' => $listPosition,
                'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                'pluginOptions' => [
                    'allowClear' => true,
                   // 'tags' => true,
                ],
            ]);
            ?>
        </div>        
    </div>
