<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\persons\models\teacher\TbClassTeacherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class='box box-info'>
    <div class='box-header'>
<!--     <h3 class='box-title'><?= Yii::t('person', 'Teacher') ?></h3>-->
      <div class="box-tools pull-right">           
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div><!--box-header -->
    </div><!--box-header -->
    
    <div class='box-body pad'>
        
<!--        <p>
            <?= Html::button('<i class="fa fa-plus"></i>', ['value' => Url::to(['customer/create']), 'title' => Yii::t('person', 'Education'), 'class' => 'btn btn-primary btn-sm', 'id' => 'teacher-create-link']); ?>
        </p>-->
        
          

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'class_id',
            //'class_year',
            [
                    'attribute' => 'class_year',
                    'value' => function($model) {
                        if ($model->class_year)
                            return $model->class_year + 543;
                    },
                ],
            'class_term',
           [
                    'attribute' => 'edu_class_id',
                    'value' => function($model) {
                        if ($model->edu_class_id)
                            return $model->eduClass->edu_class_title;
                    },
                ],
            'class_room',
            'class_note',
            // 'person_id',
//            [
//                    'class' => 'yii\grid\ActionColumn',
//                    //'template' => '{update} {delete}',
//                    'template' => '{update} {delete}',
//                    'buttons' => [
//                        'delete' => function ($url, $model, $key) {
//
//                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', '#', [
//                                        'class' => 'teacher-delete-link',
//                                        'title' => 'ลบข้อมูล',
//                                        // 'data-toggle' => 'modal',
//                                        // 'data-target' => '#study-modal',
//                                        'data-id' => $key,
//                                        'data-pjax' => '0',
//                                        'data-method' => 'post',
//                            ]);
//                        },
//                                'update' => function ($url, $model, $key) {
//                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#', [
//                                        'class' => 'teacher-update-link',
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
    ]); ?>


    </div><!--box-body pad-->
 </div><!--box box-info-->
 <?php
        $urlCreate = Url::to(['/persons/teacher/create-ajax', 'id' => $person->person_id]);
        $urlUpdate = Url::to(['/persons/teacher/update-ajax', 'person' => $person->person_id]);
        $urlDelete = Url::to(['/persons/teacher/delete-ajax', 'person' => $person->person_id]);


        $this->registerJs('        
            $("#teacher-create-link").click(function(e) {
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
            $(".teacher-delete-link").click(function(e) {
                    var fID = $(this).closest("tr").data("key");
                    $.get(
                        "' . $urlDelete . '",
                        {
                            id: fID
                        },
                        function (data)
                        {
                            //$.pjax.reload({container:"#customer_pjax_id"});
                            /*$("#form-modal").find(".modal-body").html(data);
                            //$("#form-modal .modal-body").html(data);
                            //$("#form-modal .modal-title").html("เปิดดูข้อมูล");*/
                            //$("#form-modal").modal("show");
                        }
                    );
                });
            $(".teacher-update-link").click(function(e) {
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