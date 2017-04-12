<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\BaseStringHelper;
/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\activity\TbActivity */
//$content = BaseStringHelper::truncate($content,200);
$this->title = BaseStringHelper::truncate($model->activity_title,50);
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'Tb Activities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>

    <p>
        <?= Html::a(Yii::t('person', 'Update'), ['update', 'id' => $model->activity_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('person', 'Delete'), ['delete', 'id' => $model->activity_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('person', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'activity_id',
            'activity_title',
            'activity_start:datetime',
            'activity_end:datetime',
            'location_id',
            'activity_cate_id',
            'activity_status',
        ],
    ]) ?>


    </div><!--box-body pad-->
 </div><!--box box-info-->
