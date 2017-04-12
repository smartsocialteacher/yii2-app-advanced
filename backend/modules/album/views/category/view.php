<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

//use \backend\modules\album\models\TbAlbumCategory;
/* @var $this yii\web\View */
/* @var $model backend\modules\album\models\TbAlbumCategory */

$this->title = $model->album_cate_title;
$this->params['breadcrumbs'][] = ['label' => 'Tb Album Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$cate_parent = $model->CateParent($model->album_cate_parent_id);
$cate_title = $cate_parent?$cate_parent->album_cate_title:"-";

?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->album_cate_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->album_cate_id], [
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
            //'album_cate_id',
            'album_cate_title',
            'album_cate_folder',
            //'album_cate_parent_id',
//            [
//              'attribute'  => 'album_cate_parent_id',
//              'value' => $cate_parent,
//             // 'format' => 'html'
//              //'visible' => $model->album_cate_parent_id !== null,
//              //'filter '=>$model->albumCateParent
//            ]
        ],
    ]) ?>

    </div><!--box-body pad-->
 </div><!--box box-info-->
