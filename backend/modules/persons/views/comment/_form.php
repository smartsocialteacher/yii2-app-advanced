<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\widgets\CKEditor;
/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\TbPersonComment */
/* @var $form yii\widgets\ActiveForm */
use backend\modules\persons\models\TbPerson;
$listPerson = ArrayHelper::map(TbPerson::find()->all(),'person_id','fullname');


?>

<div class="tb-person-comment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'person_id')->dropDownList($listPerson) ?>

    <?= $form->field($model, 'person_comment_datetime')->hiddenInput(['value'=>date("Y-m-d H:i:s")])->label(false) ?>

    <?= $form->field($model, 'person_comment_highlight')->textarea(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'person_comment')->widget(CKEditor::className(), [
        'options' => ['rows' =>50],
        'preset' => 'custom',
    	'clientOptions' => [
	        'toolbarGroups' => [
	            ['name' => 'document', 'groups' => ['mode', 'document', 'doctools' ]],
	            ['name' => 'clipboard', 'groups' => ['clipboard', 'undo' ]],
	            ['name' => 'editing', 'groups' => ['find', 'selection', 'spellchecker' ]],
	            '/',
	            ['name' => 'basicstyles', 'groups' => ['basicstyles', 'cleanup' ]],
	            ['name' => 'paragraph', 'groups' => ['list', 'indent', 'blocks', 'align', 'bidi' ]],
	            ['name' => 'links'],
	            ['name' => 'insert'],
	            '/',
	            ['name' => 'styles'],
	            ['name' => 'colors'],
	            ['name' => 'tools'],
	            ['name' => 'others']
	        ],
                'extraPlugins' => 'youtube'
   		],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('person', 'Create') : Yii::t('person', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
