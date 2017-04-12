<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

//use prawee\widgets\ButtonAjax;
//use kartik\grid\GridView;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<span ></span>
<div class='box box-info' >
    <div class='box-header'>
<!--        <h3 class='box-title' ><?= Yii::t('person', 'Education') ?></h3>-->
        <div class="box-tools pull-right">           
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div><!--box-header -->
    </div><!--box-header -->



    <div class='box-body pad'>
<!--        <p>
        <?= Html::button('<i class="fa fa-plus"></i>', ['value' => Url::to(['customer/create']), 'title' => Yii::t('person', 'Education'), 'class' => 'btn btn-primary btn-sm', 'id' => 'study-create-link']); ?>
        </p>-->
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'study_id',
                //'study_year_finish',
                //'edu_level_id',
                //'person_id', 
                [
                    'attribute' => 'study_year_finish',
                    'value' => function($model) {
                        if ($model->study_year_finish)
                            return $model->study_year_finish + 543;
                    },
                ],
                [
                    'attribute' => 'edu_level_id',
                    'value' => function($model) {
                        if ($model->edu_level_id)
                            return $model->eduLevel->edu_level_title;
                    },
                ],
                [
                    'attribute' => 'edu_local_id',
                    'value' => function($model) {
                        if ($model->edu_local_id)
                            return $model->eduLocal->edu_local_title;
                    },
                ],
                [
                    'attribute' => 'major_id',
                    'value' => function($model) {
                        if ($model->major_id)
                            return $model->major->major_title;
                    },
                ],
                [
                    'attribute' => 'degree_id',
                    'value' => function($model) {
                        if ($model->degree_id)
                            return $model->degree->degree_title;
                    },
                ],
                [
                    'attribute' => 'study_toplevel',
                    'format' => 'html',
                    'value' => function($model) {
                        return ($model->study_toplevel) ? '<i class="fa fa-check"></i>' : '';
                    },
                ],
//                [
//                    'class' => 'yii\grid\ActionColumn',
//                    'template' => '{update} {delete}',
//                    'buttons' => [
//                        'delete' => function ($url, $model, $key) {
//
//                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', '#', [
//                                        'class' => 'study-delete-link',
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
//                                        'class' => 'study-update-link',
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
        $urlCreate = Url::to(['/persons/study/create-ajax', 'id' => $person->person_id]);
        $urlUpdate = Url::to(['/persons/study/update-ajax', 'person' => $person->person_id]);
        $urlDelete = Url::to(['/persons/study/delete-ajax', 'person' => $person->person_id]);


        $this->registerJs('        
            $("#study-create-link").click(function(e) {
                //alert(55);
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
            $(".study-delete-link").click(function(e) {
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
                            // $("#form-modal .modal-body").html(data);
                            //$(".modal-title").html("เปิดดูข้อมูล");*/
                            //$("#form-modal").modal("show");
                        }
                    );
                });
            $(".study-update-link").click(function(e) {
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