<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\articles\models\TbArticleCategory */
/* @var $form yii\widgets\ActiveForm */

use app\widgets\CKEditor;
?>

<div class="tb-article-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'art_cate_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'art_cate_intro')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'custom',
    	'clientOptions' => [
	        'toolbarGroups' => [
	            ['name' => 'clipboard', 'groups' => ['clipboard', 'undo' ]],
	            ['name' => 'basicstyles', 'groups' => ['basicstyles', 'cleanup' ]],
	        ],
   		],
    ]) ?>

    <?= $form->field($model, 'art_cate_created')->textInput() ?>

    <?= $form->field($model, 'art_cate_created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'art_cate_parent_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
