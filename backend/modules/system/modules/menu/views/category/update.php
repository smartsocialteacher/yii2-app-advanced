<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\system\modules\menu\models\SysMenuCategory */

$this->title = 'Update Sys Menu Category: ' . ' ' . $model->menu_cate_id;
$this->params['breadcrumbs'][] = ['label' => 'Sys Menu Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->menu_cate_id, 'url' => ['view', 'id' => $model->menu_cate_id]];
$this->params['breadcrumbs'][] = 'Update';
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
