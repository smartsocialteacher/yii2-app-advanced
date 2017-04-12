<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\system\modules\menu\models\SysMenu */

$this->title = 'Update Sys Menu: ' . ' ' . $model->menu_id;
$this->params['breadcrumbs'][] = ['label' => 'Sys Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->menu_id, 'url' => ['view', 'id' => $model->menu_id]];
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
