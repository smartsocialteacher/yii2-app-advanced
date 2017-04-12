<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\persons\models\activity\TbActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('person', 'Tb Activities');
$this->params['breadcrumbs'][] = $this->title;

use yii\helpers\ArrayHelper;
use backend\modules\persons\models\activity\TbActivity;
use backend\modules\persons\models\activity\TbActivityCategory;

$listActCate = ArrayHelper::map(TbActivityCategory::find()->all(), 'activity_cate_id', 'activity_cate_title');

use backend\modules\persons\models\activity\TbLocation;

$listLocation = ArrayHelper::map(TbLocation::find()->all(), 'location_id', 'location_title');
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->

    <div class='box-body pad'>

        <p>
        <?= Html::a(Yii::t('person', 'Create Tb Activity'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'activity_id',
                'activity_title',
                //'activity_detail:ntext',
                'activity_start:datetime',
                'activity_end:datetime',
                //'location_id',
                [
                    'attribute' => 'location_id',
                    'filter' => $listLocation,
                    'value' => function($model) {
                    if($model->location_id)
                        return $model->location->location_title;
                    }
                ],
                [
                    'attribute' => 'activity_cate_id',
                    'filter' => $listActCate,
                    'value' => function($model) {
                        if($model->activity_cate_id)
                        return $model->activityCate->activity_cate_title;
                    }
                ],
                [
                    'attribute' => 'activity_status',
                    'filter' => TbActivity::itemsAlias('activity_status'),
                    'value' => function($model) {
                    if($model->activity_status)
                        return $model->activityStatus;
                    }
                ],
                [
                    'label' => Yii::t('person', 'จำนวนคน'),
                    'value' => function ($model, $key, $index, $column) {
                        return count($model->tbActivityJoins);
                    },
                ],
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>


    </div><!--box-body pad-->
</div><!--box box-info-->
