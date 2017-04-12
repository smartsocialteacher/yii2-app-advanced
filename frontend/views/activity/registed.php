<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\BaseStringHelper;
use yii\helpers\Url;

$baseUrl = Yii::getAlias('@web');
$basePath = Yii::getAlias('@webroot');
$url = Url::to(['/activity/view', 'id' => $modelAct->activity_id]);
/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\activity\TbActivity */
//$content = BaseStringHelper::truncate($content,200);
$this->title = Yii::t('person', 'ลงทะเบียน');
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'กิจกรรม/สัมมนา'), 'url' => ['/activity']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
        <?=
        Html::tag('h2', Html::encode($this->title))
        ?>
        <?=Html::tag('h1','<i class="fa fa-check-circle"></i> เรียบร้อย',['class'=>'green text-left','style'=>'color:#5CB85C;padding:10px;'] )?>
    </div><!--box-header -->

    <div class='box-body pad'>

        <?=
        DetailView::widget([
            'model' => $modelAct,
            'attributes' => [
                'activity_title',
                 [
                    'attribute' => 'location_id',
                    'value' => $modelAct->location->location_title,
                ],
                 [
                    'label' => 'วันเวลา',
                    'value' => $modelAct->activity_start." ".Yii::t('person','ถึง')." ".$modelAct->activity_end,
                ],
            ]
        ])
        ?>
        <?=
        DetailView::widget([
            'model' => $modelPerson,
            'attributes' => [
                //'activity_id',
                'person_id_card',
                'fullName',
                // 'person_sex', 
                [
                    'attribute' => 'person_sex',
                    'value' => $modelPerson->sexName,
                ],
                [
                    'attribute' => 'person_type_id',
                    'value' => $modelPerson->personType->person_type_title,
                ],
                [
                    'attribute' => 'position_id',
                    'value' => $modelPerson->position->position_title,
                ],
                'person_birthday:date',
                'person_mobile',
                'person_email:email',
            ],
        ])
        ?>
        
        <?php if($modelStudy): ?>
        <?=Html::tag('h4', Yii::t('person','Education'))?>
        <?=
        DetailView::widget([
            'model' => $modelStudy,
            'attributes' => [
                [
                    'attribute' => 'edu_level_id',
                    'value' => $modelStudy->eduLevel->edu_level_title,
                ],                 
                [
                    'attribute' => 'edu_local_id',
                    'value' => $modelStudy->edu_local_id?$modelStudy->eduLocal->edu_local_title:null,
                ],                                
                [
                    'attribute' => 'degree_id',
                    'value' => $modelStudy->degree_id?$modelStudy->degree->degree_title:null,
                ],                 
                [
                    'attribute' => 'major_id',
                    'value' => $modelStudy->major_id?$modelStudy->major->major_title:null,
                ],                 
            ]
        ])
        ?>
        <?php endif;?>
        
        <?php if($modelPersonnel):?>
        <?=Html::tag('h4', Yii::t('person','Performance'))?>
        <?=DetailView::widget([
            'model' => $modelPersonnel,
            'attributes' => [
                [
                    'attribute' => 'school_id',
                    'value' => $modelPersonnel->school->school_title,
                ],
                [
                    'attribute' => 'position_id',
                    'value' => $modelPersonnel->position->position_title,
                ]             
            ]
        ])
        ?>
        <?php endif?>
        
        <br />
        
<?= Html::a(Yii::t('person', 'กลับไปหน้ากิจกรรม'), Url::to(['/activity']), ['class' => 'btn btn-info']); ?> 
<?= Html::a(Yii::t('person', 'ลงทะเบียนใหม่'), Url::to(['/activity/register', 'id' => $modelAct->activity_id]), ['class' => 'btn btn-warning']); ?>
    </div><!--box-body pad-->
</div><!--box box-info-->
