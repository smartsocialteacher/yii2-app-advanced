<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\album\models\TbAlbum */

$this->title = 'Update Tb Album: ' . ' ' . $model->album_id;
$this->params['breadcrumbs'][] = ['label' => 'Tb Albums', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->album_id, 'url' => ['view', 'id' => $model->album_id]];
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
