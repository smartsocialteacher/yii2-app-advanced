<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\modules\system\modules\menu\models\SysMenu */
/* @var $form yii\widgets\ActiveForm */
use app\modules\system\modules\menu\models\SysMenu;
$menu_parent = SysMenu::find()->all();
$listParent = ArrayHelper::map($menu_parent,'menu_id','menu_title');

use app\modules\system\modules\menu\models\SysMenuCategory;
$menu_cate = SysMenuCategory::find()->all();
$listCate = ArrayHelper::map($menu_cate,'menu_cate_id','menu_cate_title');

//$css="
//.form-inline .form-group{
//    margin-left: 0;
//    margin-right: 0;
//}";
//
//$this->registerCss($css);


?>


<div class="sys-menu-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{error}\n{endWrapper}\n{hint}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-3',
                'offset' => 'col-sm-offset-3',
                'wrapper' => 'col-sm-7',
                'error' => '',
                'hint' => 'col-sm-2',
            ],
        ],
    ]); 
    ?>
    <?php $inputTemplate=' <div class="form-group">{label}<div class="col-sm-9">{input}{error}{hint}</div></div>'; ?>
    
    <?= $form->field($model, 'menu_title')->textInput(['maxlength' => true])->hint('Hint text'); ?>
    
    
    <?= $form->field($model, 'menu_link')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'menu_parameter')->textInput(['maxlength' => true]) ?>
       
<!--    <div class="form-inline">-->
    <?php $inputTemplate="{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}"; ?>
    <?= $form->field($model, 'menu_cate_id',[
//        'template' => $inputTemplate,
//        'horizontalCssClasses' => [
//                'label' => 'col-sm-6',
//                'offset' => 'col-sm-offset-6',
//                'wrapper' => 'col-sm-4'
//            ]
        ])->dropDownList($listCate,['prompt'=>'เลือก']) ?>
    
    <?= $form->field($model, 'menu_parent_id',[
//        'horizontalCssClasses' => [
//                'label' => 'col-sm-6',
//                'offset' => 'col-sm-offset-6',
//                'wrapper' => 'col-sm-4'
//            ]
        ])->dropDownList($listParent)?>
<!--   </div>-->
   

    <?= $form->field($model, 'mod_id')->textInput() ?>

    <?= $form->field($model, 'menu_published')->dropDownList([ 1 => '1', 0 => '0', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'menu_access')->dropDownList([ 1 => '1', 0 => '0', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'menu_target')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'menu_ptc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'menu_params')->textInput() ?>

    <?= $form->field($model, 'menu_home')->dropDownList([ 1 => '1', 0 => '0', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'menu_sort')->textInput() ?>

    <?= $form->field($model, 'language')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'menu_assoc')->textInput(['maxlength' => true]) ?>

  <div class="form-group">
      <label class="col-sm-3">&nbsp;</label>
    <div class="col-sm-offset-3">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
      </div>

    <?php ActiveForm::end(); ?>

</div>
