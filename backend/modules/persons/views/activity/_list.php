<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\persons\models\activity\TbActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\helpers\ArrayHelper;
use backend\modules\persons\models\activity\TbActivity;
use backend\modules\persons\models\activity\TbActivityCategory;

$listActCate = ArrayHelper::map(TbActivityCategory::find()->all(), 'activity_cate_id', 'activity_cate_title');

use backend\modules\persons\models\activity\TbLocation;

$listLocation = ArrayHelper::map(TbLocation::find()->all(), 'location_id', 'location_title');
?>

<?=

GridView::widget([
    'dataProvider' => $dataProvider,
    //'filterModel' => $searchModel,
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
//        [
//            'attribute' => 'activity_status',
//            'filter' => TbActivity::itemsAlias('activity_status'),
//            'value' => function($model) {
//                return $model->activityStatus;
//            }
//        ],
        
        [
            'label' => Yii::t('person', 'เลือก'),
            'format' => 'html',
            'value' => function ($model, $key, $index, $column) {
           // print_r($model->tbActivityJoins->);
                return Html::a('<span class="glyphicon glyphicon-trash"></span> เข้าร่วม', \yii\helpers\Url::to(['create-ajax','id'=>2,'activity_id'=>$model->activity_id]), [
                      'class' => 'btn btn-success'
                    
                ]);
            },
                ],
            ],
        ]);
        ?>