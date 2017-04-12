<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\persons\models\teach\TbTeachSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
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
            <?= Html::button('<i class="fa fa-plus"></i>', ['value' => Url::to(['customer/create']), 'title' => Yii::t('person', 'Education'), 'class' => 'btn btn-primary btn-sm', 'id' => 'teach-create-link']); ?>
        </p>-->

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
               
                [
                    'attribute' => 'teach_year',
                    'value' => function($model) {
                        if ($model->teach_year)
                            return $model->teach_year + 543;
                    },
                ],
               
                
                'teach_term',                
                [
                    'attribute' => 'edu_class_id',
                    'value' => function($model) {
                        if ($model->edu_class_id)
                            return $model->eduClass->edu_class_title;
                    },
                ],
                
                             [
                    'attribute' => 'subject_id',
                    'value' => function($model) {
                        if ($model->subject_id)
                            return $model->subject->subject_title;
                    },
                ],
                'teach_hoursPweek',
//                [
//                    'class' => 'yii\grid\ActionColumn',
//                    'template' => '{update} {delete}',
//                    'buttons' => [
//                        'delete' => function ($url, $model, $key) {
//
//                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', '#', [
//                                        'class' => 'teach-delete-link',
//                                        'title' => 'เปิดดูข้อมูล',
//                                        // 'data-toggle' => 'modal',
//                                        // 'data-target' => '#teach-modal',
//                                        'data-id' => $key,
//                                        'data-pjax' => '0',
//                                        'data-method' => 'post',
//                            ]);
//                        },
//                                'update' => function ($url, $model, $key) {
//                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#', [
//                                        'class' => 'teach-update-link',
//                                        'title' => 'แก้ไขข้อมูล',
//                                        'data-toggle' => 'modal',
//                                        'data-target' => '#form-modal',
//                                        'data-id' => $key,
//                                        'data-pjax' => '0',
//                            ]);
//                        },
//                    ]
//                ],
            ],
        ]);
        ?>


    </div><!--box-body pad-->
</div><!--box box-info-->
<?php
        $urlCreate = Url::to(['/persons/teach/create-ajax', 'id' => $person->person_id]);
        $urlUpdate = Url::to(['/persons/teach/update-ajax', 'person' => $person->person_id]);
        $urlDelete = Url::to(['/persons/teach/delete-ajax', 'person' => $person->person_id]);


        $this->registerJs('        
            $("#teach-create-link").click(function(e) {
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
            $(".teach-delete-link").click(function(e) {
                    var fID = $(this).closest("tr").data("key");
                    $.get(
                        "' . $urlDelete . '",
                        {
                            id: fID
                        },
                        function (data)
                        {
                            //$.pjax.reload({container:"#customer_pjax_id"});
                            /*$("#teach-modal").find(".modal-body").html(data);
                            //$("#form-modal .modal-body").html(data);
                            //$("#form-modal .modal-title").html("เปิดดูข้อมูล");*/
                            //$("#teach-modal").modal("show");
                        }
                    );
                });
            $(".teach-update-link").click(function(e) {
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