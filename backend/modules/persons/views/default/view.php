<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\TbPerson */

//$this->title = $model->antecedent->antecedent_title . " " . $model->person_name . " " . $model->person_surname;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'Tb People'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <?= Html::tag('h3', Yii::t('person', 'ข้อมูลทั่วไป'),['class'=>'box-title']);?>
        
        <div class="box-tools pull-right">
        <?=Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => $model->person_id], [
                'class' => 'btn btn-danger btn-sm',
                'title' =>  Yii::t('person', 'Delete'),
                'data' => [
                    'confirm' => Yii::t('person', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])?>
             <?= Html::a('<i class="fa fa-pencil"></i>', ['update', 'id' => $model->person_id], ['class' => 'btn btn-primary btn-sm','title'=>Yii::t('person', 'Update')]) ?>
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>        
    </div><!--box-header -->

    <div class='box-body pad'>
        
    
    
        <?=
        DetailView::widget([
            'model' => $model,
            'template'=>'<tr><th style="text-align: left;width:200px" nowrap="" >{label}</th><td>{value}</td></tr>',
            'attributes' => [
                'person_id_card',
                'fullName',
                // 'person_sex', 
                [
                    'attribute' => 'person_sex',
                    'value' => $model->sexName,
                ],
                [
                    'attribute' => 'person_type_id',
                    'value' => $model->personType->person_type_title,
                ],
                [
                    'attribute' => 'position_id',
                    'value' => $model->position->position_title,
                ],
                [
                    'attribute' => 'person_birthday',
                    'value' => Yii::$app->formatter->asDate($model->person_birthday, 'medium'),
                ],
                'person_blood_groups',
                [
                    'attribute' => 'race_id',
                    'value' => $model->race->race_title,
                ],
                [
                    'attribute' => 'nationality_id',
                    'value' => $model->nationality->nationality_title,
                ],
                [
                    'attribute' => 'religion_id',
                    'value' => $model->religion->religion_title,
                ],
                'person_phone',
                'person_mobile',
                'person_email:email',
            ],
        ])
        ?> 
        

    </div><!--box-body pad-->
</div><!--box box-info-->