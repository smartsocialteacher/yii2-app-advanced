<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\widgets\Affix;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\TbPerson */

$this->title = $person->antecedent->antecedent_title . " " . $person->person_name . " " . $person->person_surname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'บุคคล'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;



$items1 = [
    [
        'url' => '#profile',
        'label' => Yii::t('person', 'General'),
        'icon' => 'glyphicon glyphicon-info-sign text-red',
        'content' => '',
        'items' => [
            [
                'url' => '#profile',
                'label' => Yii::t('person', 'ข้อมูลทั่วไป'),
                'icon' => 'glyphicon glyphicon-user text-green',
                'content' => $this->render('profile/person', ['model' => $person]),
            ],
            [
                'url' => '#address',
                'label' => Yii::t('person', 'Address'),
                'icon' => 'glyphicon glyphicon-map-marker text-green',
                'content' => $this->render('profile/address', [
                    'dataProvider' => $address,
                    'person' => $person
                        ]
                ),
            ],
        ],
    ],
    [
        'url' => '#study',
        'label' => Yii::t('person', 'Education'),
        'icon' => 'glyphicon glyphicon-education text-red',
        'content' => '',
        'items' => [
            [
                'url' => '#study',
                'label' => Yii::t('person', 'ด้านการศึกษา'),
                'icon' => 'glyphicon glyphicon-education text-green',
                'content' => $this->render('profile/study', [
                    'dataProvider' => $study,
                    'person' => $person
                ]),
            ]
        ]
    ],
    [
        'url' => '#performance',
        'label' => Yii::t('person', 'ประวัติการปฎิบัติงาน'),
        'icon' => 'glyphicon glyphicon-blackboard text-red',
        'content' => '',
        'items' => [

            [
                'url' => '#performance',
                'label' => Yii::t('person', 'Performance'),
                'icon' => 'glyphicon glyphicon-compressed text-green',
                'content' => $this->render('profile/performance', [
                    'dataProvider' => $personnel,
                    'person' => $person
                ]),
            ],
            [
                'url' => '#teacher',
                'label' => Yii::t('person', 'Teacher'),
                'icon' => 'glyphicon glyphicon-briefcase text-green',
                'content' => $this->render('profile/teacher', [
                    'person' => $person,
                    'dataProvider' => $teacher,
                ]),
            ],
            [
                'url' => '#teach',
                'label' => Yii::t('person', 'ด้านการสอน'),
                'icon' => 'glyphicon glyphicon-globe text-green',
                'content' => $this->render('profile/teach', [
                    'person' => $person,
                    'dataProvider' => $teach,
                ]),
            ],
            [
                'url' => '#activity',
                'label' => Yii::t('person', 'Activity'),
                'icon' => 'glyphicon glyphicon-bullhorn text-green',
                'content' => $this->render('profile/activity', [
                    'person' => $person,
                    'dataProvider' => $activity,
                ]),
            ],
        ],
    ],
];
#################################################################
$items2 = [
    [
        'url' => '#profile',
        'label' => Yii::t('person', 'General'),
        'icon' => 'glyphicon glyphicon-info-sign text-red',
        'content' => '',
        'items' => [
            [
                'url' => '#profile',
                'label' => Yii::t('person', 'ข้อมูลทั่วไป'),
                'icon' => 'glyphicon glyphicon-user text-green',
                'content' => $this->render('profile/person', ['model' => $person]),
            ],
            [
                'url' => '#address',
                'label' => Yii::t('person', 'Address'),
                'icon' => 'glyphicon glyphicon-map-marker text-green',
                'content' => $this->render('profile/address', [
                    'dataProvider' => $address,
                    'person' => $person
                        ]
                ),
            ],
        ],
    ],
    [
        'url' => '#school',
        'label' => Yii::t('person', 'ข้อมูลโรงเรียน'),
        'icon' => 'glyphicon glyphicon-education text-red',
        'content' => '',
        'items' => [
            [
                'url' => '#personnel',
                'label' => Yii::t('person', 'การบรรจุเป็นบุคลากรด้านการศึกษา'),
                'icon' => 'glyphicon glyphicon-compressed text-green',
                'content' => $this->render('profile/performance', [
                    'dataProvider' => $personnel,
                    'person' => $person
                ]),
            ],
        ]
    ],
    [
        'url' => '#performance',
        'label' => Yii::t('person', 'ประวัติการปฎิบัติงาน'),
        'icon' => 'glyphicon glyphicon-blackboard text-red',
        'content' => '',
        'items' => [
            [
                'url' => '#teacher',
                'label' => Yii::t('person', 'Teacher'),
                'icon' => 'glyphicon glyphicon-briefcase text-green',
                'content' => $this->render('profile/teacher', [
                    'person' => $person,
                    'dataProvider' => $teacher,
                ]),
            ],
            [
                'url' => '#teach',
                'label' => Yii::t('person', 'ด้านการสอน'),
                'icon' => 'glyphicon glyphicon-globe text-green',
                'content' => $this->render('profile/teach', [
                    'person' => $person,
                    'dataProvider' => $teach,
                ]),
            ],
        ],
    ],
    [
        'url' => '#study_develop',
        'label' => Yii::t('person', 'ประวัติการศึกษาและการพัฒนา'),
        'icon' => 'glyphicon glyphicon-blackboard text-red',
        'content' => '',
        'items' => [

            [
                'url' => '#study',
                'label' => Yii::t('person', 'ด้านการศึกษา'),
                'icon' => 'glyphicon glyphicon-education text-green',
                'content' => $this->render('profile/study', [
                    'dataProvider' => $study,
                    'person' => $person
                ]),
            ],
            [
                'url' => '#activity',
                'label' => Yii::t('person', 'Activity'),
                'icon' => 'glyphicon glyphicon-bullhorn text-green',
                'content' => $this->render('profile/activity', [
                    'person' => $person,
                    'dataProvider' => $activity,
                ]),
            ],
        ],
    ],
];

$items = ($person->position_id >= 5) ? $items1 : $items2;
//print_r($items);
?>
<div class="row">
    <div class="col-sm-3">
        <div class="box box-solid kv-sidebar hidden-print-affix">
            <!--<div class="box-header with-border">
                  <h3 class="box-title">Profile</h3>
                             <div class="box-tools">
                                 <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                               </div>
            </div>-->
            <div class="box-body no-padding" >
                <div style="background-color: #00a65a;margin-top: -15px;padding: 10px;color:#fff;">
                <div class="img img-thumbnail" style="overflow: hidden;height: 200px;width: 100%;" >
                    <?=
                    Html::img(
                            ($person->img_id) ? Yii::$app->img->getUploadUrl($person->img->img_path_file) . $person->img_id : Yii::$app->img->getNoimg()
                            , [
                        'width' => '100%',
                        'class' => ''
                    ]);
                    ?>


                    <?= Html::button('<i class="glyphicon glyphicon-camera"></i>', ['value' => Url::to(['customer/create']), 'title' => Yii::t('person', 'Education'), 'class' => 'btn btn-default modal-img photo']);
                    ?> 
                </div><!--img-->
                <hr />
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <i class="fa fa-info-circle"></i> <?= $person->fullName ?></div>
                    <div class="col-sm-10 col-sm-offset-1">
                        <i class="fa fa-info-circle"></i> <?= $person->personType->person_type_title ?></div>
                    <div class="col-sm-10 col-sm-offset-1">
                        <i class="fa fa-info-circle"></i> <?= $person->position->position_title ?></div>
                </div>     
                </div>
                <?php
                echo Affix::widget([
                    'items' => $items,
                    'options' => [
                        'class' => 'nav-pills nav-stacked',
                        'style' => 'background-color:#fff;']
                ]);
                ?>
            </div><!-- /.box-body -->

        </div>

    </div>
    <div class="col-sm-9" >        
        <?php
        Modal::begin([
            'id' => 'form-modal',
            'header' => '<h4 class="modal-title">#</h4>',
            'size' => 'modal-lg',
                //'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">ปิด</a>',
        ]);
        Modal::end();
        ?>
        <?php
        echo Affix::widget([
            'type' => 'body',
            'items' => $items,
            'secTemplate' => '<div id="{id}"><div class="kv-section">{content}{subSection}</div></div>'
        ]);
        ?>
    </div>
</div>    
<?php
$this->registerCss(" 
        
.img{
position:relative;
}
.img .modal-img{
position:absolute;
bottom:10px;
right:15px;
z-index:99px;
}



");




$this->registerJs(' 
    $(".photo").click(function(e) {
        //alert(55);        
        $("#modal-img").modal("show");
    });
');
?>

<?php
Modal::begin(['id'=>'modal-img']);
$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>



                <?=
                $form->field(new \backend\modules\slide\models\TbImages, 'img_name_file')->widget(FileInput::classname(), [
                    //'options' => ['accept' => 'image/*'],
                    'pluginOptions' => [
                        'showCaption' => false,
                        'showRemove' => false,
                        'showUpload' => true,
                        'uploadUrl' => Url::to([ '/persons/default/img', "id" => $person->person_id]),
                        'showPreview' => true,
                        'browseClass' => 'btn btn-primary',
                        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                        'browseLabel' => 'Select Photo'
                    ],
                    'options' => ['accept' => 'image/*']
                ]);
                ?>


<?php
ActiveForm::end();
Modal::end();
