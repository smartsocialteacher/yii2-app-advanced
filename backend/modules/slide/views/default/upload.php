<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\Url;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\modules\slide\models\TbSlide */

$this->title = $model->slide_title;
$this->params['breadcrumbs'][] = ['label' => 'Tb Slides', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>
     <?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data']    
    ]); ?>
    <?= $form->field($model, 'slide_id')->hiddenInput()->label(false);?>
    
    
    <div class="row">
        <div class="col-sm-12">
        <?=FileInput::widget([
            'model' => $model,
            //'name' => 'image_slide',
            'attribute' => 'img_id',
            'options' => [
                'accept' => 'image/*',
                //'multiple' => true
            ], 
            'pluginOptions' => [
               'uploadUrl' => Url::to(['/slide/default/uploadajax']),
               //'overwriteInitial'=>false,
               'initialPreviewShowDelete'=>true,
               'initialPreview'=> $initialPreview,
               'initialPreviewConfig'=> $initialPreviewConfig,        
                'uploadExtraData' => [
                    'slide_id' => $model->slide_id,
                 ],
                //'maxFileCount' => 1,
                
                ], 
        ]);
        ?>
            ขนาดที่ต้องการ
            <?=Yii::$app->params['slideWidth']."x".Yii::$app->params['slideHieght'];?>
        </div>
        
    </div>
        <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'slide_detail')->widget(CKEditor::className(), [
                    'options' => ['rows' => 3],
                    'preset' => 'custom',
                    'clientOptions' => [
                        'toolbarGroups' => [
                            ['name' => 'document', 'groups' => ['mode']],
                            ['name' => 'basicstyles', 'groups' => ['basicstyles']],	            
                        ],
                        'allowedContent' => true,
                    ],
                ])  ?>
        </div>            
    </div>
        <br />
        
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'slide_id',
            //'slide_cate_id',
            [
                'attribute'=>'slide_cate_id',
                'value'=> $model->slideCate->slide_cate_title
            ],
            //'slide_title',
            //'img_id',
            'slide_link',
            'slide_date_create',
            'slide_published',
            'slide_sort',
            'slide_start',
            'slide_end',
            //'user_id',
            [
                'attribute'=>'user_id',
                'value'=> $model->user->username
            ],
        ],
    ]) ?>

    <br />
   
    
<br/>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
 
    <?php ActiveForm::end(); ?>

    </div><!--box-body pad-->
 </div><!--box box-info-->
 