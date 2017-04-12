<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\system\modules\menu\models\SysMenuCategory */

$this->title = $model->menu_cate_title;
$this->params['breadcrumbs'][] = ['label' => 'Sys Menu Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->menu_cate_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->menu_cate_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'menu_cate_id',
            'menu_cate_title',
            //'menu_cate_status',
            [
                'attribute' => 'menu_cate_status',
                'value' => $model->status
            ]
        ],
    ]) ?>


    </div><!--box-body pad-->
 </div><!--box box-info-->
