<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\persons\models\TbAddressSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class='box box-info'>
    <div class='box-header'>
<!--        <h3 class='box-title'><?= Yii::t('person', 'Address') ?></h3>-->
        <div class="box-tools pull-right">           
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div><!--box-header -->
    </div><!--box-header -->

    <div class='box-body pad'>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                // ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'address_on',
                    'value' => function($model) {
                        if ($model->address_on)
                            return $model->addressOn;
                    },
                ],
                'address_no',
                'address_village',
                'address_mu',
                'address_road',
                [
                    'attribute' => 'tambol_id',
                    'value' => function($model) {
                        if ($model->tambol_id)
                            return $model->tambol->tambol_name;
                    },
                ],
                [
                    'attribute' => 'amphur_id',
                    'value' => function($model) {
                        if ($model->amphur_id)
                            return $model->amphur->amphur_name;
                    },
                ],
                [
                    'attribute' => 'province_id',
                    'value' => function($model) {
                        if ($model->province_id)
                            return $model->province->province_name;
                    },
                ],
                'address_zip_code',
                // 'person_id',
//                [
//                    'class' => 'yii\grid\ActionColumn',
//                    'template' => '{update}',
//                    'buttons' => [
//
//                        'update' => function ($url, $model, $key) {
//                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#', [
//                                        'class' => 'address-update-link',
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
        $urlUpdate = Url::to(['/persons/address/update-ajax', 'person' => $person->person_id]);
        $urlDelete = Url::to(['/persons/study/delete-ajax', 'person' => $person->person_id]);


        $this->registerJs('
            $(".address-update-link").click(function(e) {
                    var fID = $(this).closest("tr").data("key");
                   // alert(fID);
                    $.get(
                        "' . $urlUpdate . '",
                        {
                            id: fID
                        },
                        function (data)
                        {                        
                            $(".modal-body").html("");
                            $("#form-modal").find(".modal-body").html(data);
                            $("#form-modal .modal-body").html(data);
                            $("#form-modal .modal-title").html("แก้ไขข้อมูล");
                            $("#form-modal").modal("show");
                        }
                    );
                });
      ');
        ?>