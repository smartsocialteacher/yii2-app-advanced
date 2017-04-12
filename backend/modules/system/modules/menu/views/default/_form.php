<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
//use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\modules\system\modules\menu\models\SysMenu */
/* @var $form yii\widgets\ActiveForm */
use backend\modules\system\modules\menu\models\SysMenu;
use kartik\widgets\Select2;

$menu_parent = SysMenu::find()->all();
$listParent = ArrayHelper::map($menu_parent, 'menu_id', 'menu_title');

use backend\modules\system\modules\menu\models\SysMenuCategory;

$menu_cate = SysMenuCategory::find()->all();
$listCate = ArrayHelper::map($menu_cate, 'menu_cate_id', 'menu_cate_title');


$target = ArrayHelper::merge(SysMenu::itemsAlias('target'), [$model->menu_target=>$model->menu_target]);
?>


<div class="sys-menu-form">

    <?php
    $form = ActiveForm::begin();
    ?>

    <?= $form->field($model, 'menu_title')->textInput(['maxlength' => true,'prompt' => 'เลือก'])
            //->hint('Hint text');
    ?>

    <div class="row" >
        <div class="col-sm-8">
            <?=
            $form->field($model, 'menu_link', [
                'inputTemplate' => '<div class="input-group"><span class="input-group-addon">URL:</span>{input}</div>',
            ])->textInput(['maxlength' => true])
            ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'menu_parameter', [
                'inputTemplate' => '<div class="input-group"><span class="input-group-addon">?</span>{input}</div>',
            ])->textInput(['maxlength' => true]) ?>
        </div>  
    </div>

    <div class="row" >
        <div class="col-sm-6">
            <?= $form->field($model, 'menu_cate_id', [])->dropDownList($listCate, ['prompt' => 'เลือก']) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'menu_parent_id', [])->dropDownList($listParent,['prompt' => 'เลือก']) ?>
        </div>  
    </div>
    
    <?php
    //$form->field($model, 'menu_icon')->dropDownList($listIcon,['prompt' => 'เลือก']) 
    echo $form->field($model, 'menu_icon')->textInput(['prompt' => 'เลือก']) 
    ?>    
    <?=  Html::a('Icon','D:/xampp/htdocs/yii2_new/backend/web/assets/d6405248/pages/UI/icons.html' ,['options'=>['target'=>'_blank']]);?>
    
    
    <div class="row" >
        <div class="col-sm-2">
            <?= $form->field($model, 'menu_sort')->textInput() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'menu_published')->dropDownList([ 1 => '1', 0 => '0',], ['prompt' => '']) ?>
        </div>  
    </div>
<!--    <div>
    <?= $form->field($model, 'mod_id')->textInput() ?>
        </div>-->

   

    <?= $form->field($model, 'menu_access')->dropDownList([ 1 => '1', 0 => '0',], ['prompt' => '']) ?>

    <?= $form->field($model, 'menu_target')->widget(Select2::classname(), [
                'data' => $target,
                'options' => ['placeholder' => Yii::t('app', 'เลือก')],
                'pluginOptions' => [
                    'allowClear' => true,
                    'tags' => true,
                ],
            ])?>

    <?= $form->field($model, 'menu_ptc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'menu_params')->textInput() ?>

    <?= $form->field($model, 'menu_home')->dropDownList([ 1 => '1', 0 => '0',], ['prompt' => '']) ?>


    <?= $form->field($model, 'language')->textInput(['maxlength' => true]) ?>

 <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::submitButton('apply', ['name'=>'apply','class' =>'btn btn-primary','value'=>'1']) ?>

    <?php ActiveForm::end(); ?>

</div>

