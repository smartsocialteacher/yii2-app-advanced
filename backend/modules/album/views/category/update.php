<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\album\models\TbAlbumCategory */

$this->title = 'Update Tb Album Category: ' . ' ' . $model->album_cate_id;
$this->params['breadcrumbs'][] = ['label' => 'Tb Album Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->album_cate_id, 'url' => ['view', 'id' => $model->album_cate_id]];
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
