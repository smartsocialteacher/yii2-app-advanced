<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\TbUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-user-form">

    <?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n{beginWrapper}\n{input}\n{error}\n{endWrapper}{hint}",
        'horizontalCssClasses' => [
            'label' => 'col-sm-2',
            'offset' => 'col-sm-offset-2',
            'wrapper' => 'col-sm-6',
            'error' => '',
            'hint' => 'col-sm-4',
        ],
    ],
]);?>

    <?= $form->field($model, 'username',['enableAjaxValidation' => true])->textInput(['maxlength' => true,'hintOptions'=>['data-toggle' => 'tooltip']])->hint('A-Za-z0-9 มากกว่า 6 ตัว') ?>
    
    
    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'password_confirm')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'displayname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_status')->textInput() ?>

    <div class="row">
        <div class="col-sm-2">&nbsp;</div>
        <div class="col-sm-offset-2">
            <div class="form-actions">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php

$js = <<< 'SCRIPT'
/* To initialize BS3 tooltips set this below */
$(function () { 
    $("[data-toggle='tooltip']").tooltip(); 
});;
/* To initialize BS3 popovers set this below */

SCRIPT;
// Register tooltip/popover initialization javascript
$this->registerJs($js);
?>
