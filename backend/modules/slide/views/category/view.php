<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\slide\models\TbSlideCategory */
use common\models\User;

$this->title = $model->slide_cate_title;
$this->params['breadcrumbs'][] = ['label' => 'จัดการสไลด์', 'url' => ['/slide']];
$this->params['breadcrumbs'][] = ['label' => 'Tb Slide Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->slide_cate_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->slide_cate_id], [
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
            //'slide_cate_id',
            'slide_cate_title',
            [
                'attribute' => 'user_id',
                'value' => $model->user->username
             ],
            [
                'label' => Yii::t('app','ขนาด'),
                'value' => $model->slide_cate_width." x ".$model->slide_cate_hiegth." px",
             ],
        ],
    ]) ?>


    </div><!--box-body pad-->
 </div><!--box box-info-->
