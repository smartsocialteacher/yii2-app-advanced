<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\album\models\TbAlbumCategory */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\ArrayHelper;
use backend\modules\album\models\TbAlbumCategory;
use kartik\widgets\Select2;

$Cate = TbAlbumCategory::find()->where(['album_cate_parent_id'=>NULL])
        ->andFilterWhere(['!=', 'album_cate_id', $model->album_cate_id])
        ->all();
$litCate =  ArrayHelper::map($Cate,'album_cate_id','album_cate_title');

?>

<div class="tb-album-category-form">

    <?php $form = ActiveForm::begin([
    'id' => 'contact-form',
    'enableAjaxValidation' => true,
]); ?>
    
    <?= $form->field($model, 'album_cate_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'album_cate_folder')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'album_cate_parent_id')->widget(Select2::classname(), [
    'data' => $litCate,
    'options' => ['placeholder' => 'เลือกภายใต้ ...'],
    'pluginOptions'=>['allowClear'=>true]
     ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
