<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\education\TbStudy */
/* @var $form yii\widgets\ActiveForm */
use backend\modules\persons\models\education\TbEduLevel;
$listEduLevel = ArrayHelper::map(TbEduLevel::find()->all(), 'edu_level_id', 'edu_level_title');

use backend\modules\persons\models\education\TbEduLocal;
$listEduLocal = ArrayHelper::map(TbEduLocal::find()->all(), 'edu_local_id', 'edu_local_title');

use backend\modules\persons\models\education\TbMajor;
$listMajor= ArrayHelper::map(TbMajor::find()->all(), 'major_id', 'major_title');

use backend\modules\persons\models\education\TbDegree;
$listDegree= ArrayHelper::map(TbDegree::find()->all(), 'degree_id', 'degree_title');

//print_r($listEduLocal);
//$study_year_finish = rage()
$range = 70;
$year = range(date('Y'), date('Y') - $range);
foreach ($year as $n)
    $study_year_finish[$n] = $n + 543;
?>

<div class="tb-study-form">
    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true, 'id' => 'studyForm']); ?>

    <div class="row">
        <div class="col-sm-3">
            <?=
            $form->field($model, 'study_year_finish')->widget(Select2::classname(), [
                'data' => $study_year_finish,
                'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                'pluginOptions' => [
                    'allowClear' => true,
                //'tags' => true,
                ],
            ])->hint('ปีการศึกษาไทย');
            ?>
        </div>
        <div class="col-sm-4">
            <?=
            $form->field($model, 'edu_level_id')->widget(Select2::classname(), [
                'data' => $listEduLevel,
                'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                'pluginOptions' => [
                    'allowClear' => true,
                //'tags' => true,
                ],
            ]);
            ?>
        </div>
        <div class="col-sm-5">
            <?=
            $form->field($model, 'edu_local_id')->widget(Select2::classname(), [
                'data' => $listEduLocal,
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
        <div class="col-sm-6">
        <?= $form->field($model, 'major_id')->widget(Select2::classname(), [
                'data' => $listMajor,
                'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                'pluginOptions' => [
                    'allowClear' => true,
                //'tags' => true,
                ],
            ]);
            ?>
        </div>
        <div class="col-sm-6">
        <?= $form->field($model, 'degree_id')->widget(Select2::classname(), [
                'data' => $listDegree,
                'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                'pluginOptions' => [
                    'allowClear' => true,
                //'tags' => true,
                ],
            ]);
            ?>
        </div>
    </div> 
        <?= $form->field($model, 'study_toplevel')->checkbox()?>
    <div class="form-group">
<?=
Html::submitButton($model->isNewRecord ? Yii::t('person', 'Create') : Yii::t('person', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'
        //,'data-dismiss'=>'modal'
])
?>
    </div>

<?php ActiveForm::end(); ?>

</div>
