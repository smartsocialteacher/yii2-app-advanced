<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\persons\models\teacher\TbPersonnelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class='box box-info' >
    <div class='box-header'>
<!--        <h3 class='box-title'><?= Yii::t('person', 'การบรรจุเป็นบุคลากรด้านการศึกษา') ?></h3>-->
         <div class="box-tools pull-right">           
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>>
        </div><!--box-header -->
    </div><!--box-header -->

    <div class='box-body pad'>

<!--        <p>
            <?= Html::button('<i class="fa fa-plus"></i>', ['value' => Url::to(['customer/create']), 'title' => Yii::t('person', 'Education'), 'class' => 'btn btn-primary btn-sm', 'id' => 'personnel-create-link']); ?>
        </p>-->


        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                            'attribute' => 'personnel_start',
                            'format' => 'html',
                            //'filter' => TbPerson::itemsAlias('sex'),
                            'value' => function($model) {
                                //return $model->person_create_at;
                                return Yii::$app->formatter->asDate($model->personnel_start, 'medium');
                            }
                ],                
                [
                            'attribute' => 'personnel_end',
                            'format' => 'html',
                            //'filter' => TbPerson::itemsAlias('sex'),
                            'value' => function($model) {
                                //return $model->person_create_at;
                                return Yii::$app->formatter->asDate($model->personnel_end, 'medium');
                            }
                        ],
                [
                    'attribute' => 'school_id',
                    'value' => function($model) {
                        if ($model->school_id)
                            return $model->school->school_title;
                    },
                ],
                [
                    'attribute' => 'position_id',
                    'value' => function($model) {
                        if ($model->position_id)
                            return $model->position->position_title;
                    },
                ],
                //'school_id',
                //'position_id',
//                [
//                    'class' => 'yii\grid\ActionColumn',
//                    'template' => '{update} {delete}',
//                    'buttons' => [
//                        'delete' => function ($url, $model, $key) {
//
//                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', '#', [
//                                        'class' => 'personnel-delete-link',
//                                        'title' => 'เปิดดูข้อมูล',
//                                        // 'data-toggle' => 'modal',
//                                        // 'data-target' => '#study-modal',
//                                        'data-id' => $key,
//                                        'data-pjax' => '0',
//                                        'data-method' => 'post',
//                            ]);
//                        },
//                                'update' => function ($url, $model, $key) {
//                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#', [
//                                        'class' => 'personnel-update-link',
//                                        'title' => 'แก้ไขข้อมูล',
//                                        'data-toggle' => 'modal',
//                                        'data-target' => '#form-modal',
//                                        'data-id' => $key,
//                                        'data-pjax' => '0',
//                            ]);
//                        },
//                            ]
//                ],
            ],
        ]);
        ?>


            </div><!--box-body pad-->
        </div><!--box box-info-->

        
  <?php
        $urlCreate = Url::to(['/persons/personnel/create-ajax', 'id' => $person->person_id]);
        $urlUpdate = Url::to(['/persons/personnel/update-ajax', 'person' => $person->person_id]);
        $urlDelete = Url::to(['/persons/personnel/delete-ajax', 'person' => $person->person_id]);


        $this->registerJs('        
            $("#personnel-create-link").click(function(e) {
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
            $(".personnel-delete-link").click(function(e) {
                    var fID = $(this).closest("tr").data("key");
                    $.get(
                        "' . $urlDelete . '",
                        {
                            id: fID
                        },
                        function (data)
                        {
                            //$.pjax.reload({container:"#customer_pjax_id"});
                            /*$("#study-modal").find(".modal-body").html(data);
                            //$("#form-modal .modal-body").html(data);
                            //$("#form-modal .modal-title").html("เปิดดูข้อมูล");*/
                            //$("#study-modal").modal("show");
                        }
                    );
                });
            $(".personnel-update-link").click(function(e) {
                    var fID = $(this).closest("tr").data("key");
                    $.get(
                        "' . $urlUpdate . '",
                        {
                            id: fID
                        },
                        function (data)
                        {
                            $("#study-modal").find(".modal-body").html(data);
                            $("#form-modal .modal-body").html(data);
                            $("#form-modal .modal-title").html("แก้ไขข้อมูล");
                            $("#study-modal").modal("show");
                        }
                    );
                });
      ');
        ?>