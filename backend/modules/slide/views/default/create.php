<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\slide\models\TbSlide */

$this->title = 'Create Tb Slide';
$this->params['breadcrumbs'][] = ['label' => 'Tb Slides', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    </div><!--box-body pad-->
 </div><!--box box-info-->
