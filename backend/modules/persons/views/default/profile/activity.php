<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\persons\models\activity\TbActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\helpers\ArrayHelper;
use backend\modules\persons\models\activity\TbActivity;
use backend\modules\persons\models\activity\TbActivityJoin;
use backend\modules\persons\models\activity\TbActivityCategory;

$listActCate = ArrayHelper::map(TbActivityCategory::find()->all(), 'activity_cate_id', 'activity_cate_title');

use backend\modules\persons\models\activity\TbLocation;

$listLocation = ArrayHelper::map(TbLocation::find()->all(), 'location_id', 'location_title');
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
        <div class="box-tools pull-right">           
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div><!--box-header -->
    </div><!--box-header -->

    <div class='box-body pad'>       
<!--        <p>
            <?= Html::button('<i class="fa fa-plus"></i>', ['value' => Url::to(['customer/create']), 'title' => Yii::t('person', 'Education'), 'class' => 'btn btn-primary btn-sm', 'id' => 'activity-create-link']); ?>
        </p>-->

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'activity_id',               
                [
                    'attribute' => 'activity.activity_title',
                    //'filter' => $listLocation,
                    'format' => 'html',
                    'value' => function($model) {
                        if ($model->activity->activity_title)
                            return $model->activity->activity_title;
                    }
                ],
                //'activity_detail:ntext',
                'activity.activity_start:datetime',
                'activity.activity_end:datetime',
                //'location_id',
                [
                    'attribute' => 'activity.location_id',
                    'filter' => $listLocation,
                    'value' => function($model) {
                        if ($model->activity->location_id)
                            return $model->activity->location->location_title;
                    }
                ],
                [
                    'attribute' => 'activity.activity_cate_id',
                    'filter' => $listActCate,
                    'value' => function($model) {
                        if ($model->activity->activity_cate_id)
                            return $model->activity->activityCate->activity_cate_title;
                    }
                ],
                [
                    'attribute' => 'person_mode',
                    'filter' => TbActivityJoin::itemsAlias('person_mode'),
                    'value' => function($model) {
                        return $model->personMode;
                    }
                ],
//                [
//                    'class' => 'yii\grid\ActionColumn',
//                    'template' => '{delete}',
//                    'buttons' => [
//                        'delete' => function ($url, $model, $key) {
//                             $url = Url::to(['/persons/activity/delete-ajax', 'person' => $model->person_id,'id'=>$model->activity_id]);
//                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
//                                        'class' => 'activity-delete-link',
//                                        'title' => 'ลบข้อมูล',
//                                        // 'data-toggle' => 'modal',
//                                        // 'data-target' => '#activity-modal',
//                                        'data-id' => $key,
//                                        'data-pjax' => '0',
//                                        'data-method' => 'post',
//                            ]);
//                        },
//                                'update' => function ($url, $model, $key) {
//                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#', [
//                                        'class' => 'activity-update-link',
//                                        'title' => 'แก้ไขข้อมูล',
//                                        'data-toggle' => 'modal',
//                                        'data-target' => '#form-modal',
//                                        'data-id' => $key,
//                                        'data-pjax' => '0',
//                            ]);
//                        },
//                            ]
//                        ],
                    ],
                ]);
                ?>


            </div><!--box-body pad-->
        </div><!--box box-info-->
        <?php
        $urlCreate = Url::to(['/persons/activity/create-ajax', 'id' => $person->person_id]);
        $urlUpdate = Url::to(['/persons/activity/update-ajax', 'person' => $person->person_id]);
        $urlDelete = Url::to(['/persons/activity/delete-ajax', 'person' => $person->person_id]);


        $this->registerJs('        
            $("#activity-create-link").click(function(e) {
                    $.get(
                        "' . $urlCreate . '",
                        function (data)
                        {
                            $("#form-modal").find(".modal-body").html(data);
                            $("#form-modal .modal-body").html(data);
                            $("#form-modal .modal-title").html("เพิ่มข้อมูล");
                            $("#form-modal").modal("show");     
                        }
                    );
                });
            $(".activity-delete-link1").click(function(e) {
                    var fID = $(this).closest("tr").data("key");
                    $.get(
                        "' . $urlDelete . '",
                        {
                            id: fID
                        },
                        function (data)
                        {                            
                        }
                    );
                });
            $(".activity-update-link").click(function(e) {
                    var fID = $(this).closest("tr").data("key");
                    $.get(
                        "' . $urlUpdate . '",
                        {
                            id: fID
                        },
                        function (data)
                        {
                            $("#form-modal").find(".modal-body").html(data);
                            $("#form-modal .modal-body").html(data);
                            $("#form-modal .modal-title").html("แก้ไขข้อมูล");
                            $("#form-modal").modal("show");
                        }
                    );
                });
      ');
        ?>
