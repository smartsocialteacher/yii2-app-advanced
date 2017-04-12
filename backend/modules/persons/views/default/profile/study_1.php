<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;
//use prawee\widgets\ButtonAjax;
//use kartik\grid\GridView;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class='box box-info' >
    <div class='box-header'>
        <h3 class='box-title' id="study"><?= Yii::t('person', 'Education') ?></h3>
        <div class="box-tools pull-right">
            <?= Html::button('<i class="fa fa-plus"></i>', ['value' => Url::to(['customer/create']), 'title' => Yii::t('person', 'Education'), 'class' => 'btn btn-primary btn-sm', 'id' => 'study-create-link']); ?>
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div><!--box-header -->
    </div><!--box-header -->






    <div class='box-body pad'>


        <?php
        Modal::begin([
            'id' => 'study-modal',
            'header' => '<h4 class="modal-title">สมาชิก</h4>',
            'size' => 'modal-lg',
            'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">ปิด</a>',
        ]);
        Modal::end();
        ?>
        <p>

        </p>
        <?php Pjax::begin(['id' => 'customer_pjax_id']); ?>

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
                'study_toplevel',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                    'buttons' => [
                        'delete' => function ($url, $model, $key) {

                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', '#', [
                                        'class' => 'study-delete-link',
                                        'title' => 'เปิดดูข้อมูล',
                                        // 'data-toggle' => 'modal',
                                        // 'data-target' => '#study-modal',
                                        'data-id' => $key,
                                        'data-pjax' => '0',
                                        'data-method' => 'post',
                            ]);
                        },
                                'update' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#', [
                                        'class' => 'study-update-link',
                                        'title' => 'แก้ไขข้อมูล',
                                        'data-toggle' => 'modal',
                                        'data-target' => '#study-modal',
                                        'data-id' => $key,
                                        'data-pjax' => '0',
                            ]);
                        },
                            ]
                        ],
                    ],
//                    'responsive' => true,
//                    'hover' => true,
//                    'floatHeader' => true,
//                    'pjax' => true,
//                    'pjaxSettings' => [
//                        'neverTimeout' => true,
//                        'enablePushState' => false,
//                        'options' => ['id' => 'CustomerGrid'],
//                    ],
                ]);
                ?>

                <?php Pjax::end() ?>
            </div><!--box-body pad-->
        </div><!--box box-info-->

        <?php
        $urlStudyCreate = Url::to(['/persons/study/create-ajax', 'id' => $person->person_id]);
        $urlUpdate = Url::to(['/persons/study/update-ajax', 'person' => $person->person_id]);
        $urlStudyDelete = Url::to(['/persons/study/delete', 'person' => $person->person_id]);


        $this->registerJs('        
            $("#study-create-link").click(function(e) {
                    $.get(
                        "' . $urlStudyCreate . '",
                        function (data)
                        {
                            $("#study-modal").find(".modal-body").html(data);
                            $(".modal-body").html(data);
                            $(".modal-title").html("เพิ่มข้อมูล");
                            $("#study-modal").modal("show");     
                        }
                    );
                });
            $(".study-delete-link").click(function(e) {
                    var fID = $(this).closest("tr").data("key");
                    $.get(
                        "' . $urlStudyDelete . '",
                        {
                            id: fID
                        },
                        function (data)
                        {
                        $.pjax.reload({container:"#customer_pjax_id"});
                            /*$("#study-modal").find(".modal-body").html(data);
                            $(".modal-body").html(data);
                            $(".modal-title").html("เปิดดูข้อมูล");*/
                            //$("#study-modal").modal("show");
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
                            $("#study-modal").find(".modal-body").html(data);
                            $(".modal-body").html(data);
                            $(".modal-title").html("แก้ไขข้อมูล");
                            $("#study-modal").modal("show");
                        }
                    );
                });
      ');
        ?>