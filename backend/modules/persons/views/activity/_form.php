<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\activity\TbActivity */
/* @var $form yii\widgets\ActiveForm */
use app\widgets\CKEditor;
//use kartik\widgets\DatePicker;
use kartik\widgets\DateTimePicker;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use backend\modules\persons\models\activity\TbActivityCategory;

$listActCate = ArrayHelper::map(TbActivityCategory::find()->all(), 'activity_cate_id', 'activity_cate_title');

use backend\modules\persons\models\activity\TbLocation;

$listLocation = ArrayHelper::map(TbLocation::find()->all(), 'location_id', 'location_title');
?>

<div class="tb-activity-form">

    <?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'activity_title')->textInput(['maxlength' => true]) ?>


    <div class="row">
        <div class='col-md-6'>
<?= $form->field($model, 'activity_cate_id')->dropDownList($listActCate, ['prompt' => Yii::t('app', 'เลือก')]) ?>
        </div>
        <div class='col-md-6'>
            <?=
            $form->field($model, 'location_id')->widget(Select2::classname(), [
                'data' => $listLocation,
                'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                'pluginOptions' => [
                    'allowClear' => true,
                    'tags' => true,
                ],
            ]);
            ?>
        </div>
    </div>
    <?=
    $form->field($model, 'activity_detail')->widget(CKEditor::className(), [
        'options' => ['rows' => 20],
        'preset' => 'custom',
        'clientOptions' => [
            'toolbarGroups' => [
                ['name' => 'document', 'groups' => ['mode', 'document', 'doctools']],
                ['name' => 'clipboard', 'groups' => ['clipboard', 'undo']],
                ['name' => 'editing', 'groups' => ['find', 'selection', 'spellchecker']],
                '/',
                ['name' => 'basicstyles', 'groups' => ['basicstyles', 'cleanup']],
                ['name' => 'paragraph', 'groups' => ['list', 'indent', 'blocks', 'align', 'bidi']],
                ['name' => 'links'],
                ['name' => 'insert'],
                '/',
                ['name' => 'styles'],
                ['name' => 'colors'],
                ['name' => 'tools'],
                ['name' => 'others']
            ],
        ],
    ])
    ?>

    <div class="row">
        <div class='col-md-4'>
            <?=
            $form->field($model, 'activity_start')->widget(DateTimePicker::classname(), [
                'language' => \Yii::$app->language,
                'value' => date('Y-m-d H:i:s'),
                'removeButton' => false,
                'pickerButton' => ['icon' => 'time'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd hh:ii:ss',
                ],
                'options' => ['class' => 'form-control']
            ])
            ?>
        </div>

        <div class='col-md-4'>  
            <?=
            $form->field($model, 'activity_end')->widget(DateTimePicker::classname(), [
                'language' => \Yii::$app->language,
                'value' => date('Y-m-d H:i:s'),
                'removeButton' => false,
                'pickerButton' => ['icon' => 'time'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd hh:ii:ss',
                ],
                'options' => ['class' => 'form-control']
            ])
            ?>
      


</div>

        <div class='col-md-4'> 




    <?= $form->field($model, 'activity_status')->dropDownList($model->getItemStatus(), ['prompt' => Yii::t('app', 'เลือก')]) ?>
  </div>
    </div>

    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? Yii::t('person', 'Create') : Yii::t('person', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
