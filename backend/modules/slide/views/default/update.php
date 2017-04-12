<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\slide\models\TbSlide */

$this->title = 'Update Tb Slide: ' . ' ' . $model->slide_id;
$this->params['breadcrumbs'][] = ['label' => 'Tb Slides', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->slide_id, 'url' => ['view', 'id' => $model->slide_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->

    <div class='box-body pad'>

        <?=
        $this->render('_form', [
            'model' => $model,
            'initialPreview' => $initialPreview,
            'initialPreviewConfig' => $initialPreviewConfig,
        ])
        ?>


    </div><!--box-body pad-->
</div><!--box box-info-->
