<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\persons\models\teach\TbSchoolSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use backend\modules\persons\models\teach\TbSchool;
use backend\modules\persons\models\teach\TbSchoolLevel;
use yii\helpers\ArrayHelper;
$listSchoolLevel = ArrayHelper::map(TbSchoolLevel::find()->all(),'school_level_id','school_level_title');

$this->title = Yii::t('person', 'Tb Schools');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>
        <?php /*= $this->render('_search',['model'=>$model])*/?>
    <p>
        <?= Html::a(Yii::t('person', 'Create Tb School'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'school_id',
            'school_title',
            [
                'label' => 'ที่อยู่',
                'value' => function($model){
        
                $address_school=$model->school_no." "
                        . $model->school_village.""
                        . $model->school_mu."";
                 $address_school.=$model->school_road.""
                        . $model->tambol_id."";
        
                    return $address_school;
                }
            ],
            //'school_no',
           // 'school_village',
            //'school_mu',
            //'school_road',
            'tambol_id',
            'amphur_id',
            'province_id',
            'phone',
            'fax',
            //'degree_id',
            //'school_level_id',
             [
                 
                 'attribute' =>'school_level_id',  
                 'filter' => $listSchoolLevel,
                 'format'=>'html',
                 'value'=>function($model){
                    $str=[];
                    foreach($model->tbSchoolLevelJions as $level)
                    $str[]='- '.$level->schoolLevel->school_level_title;
                return @implode(',<br/>',$str);
                 }
             ],
             [
                 'label' => 'จำนวนบุคลกร',
                 'attribute' =>'school_number_staff',                 
                 'value'=>function($model){
                return count($model->tbPersonnels)." ".Yii::t('person','คน');
                 }
             ],
             [
                 'attribute' =>'school_size',
                 'filter'=>TbSchool::itemsAlias('school_size'),
                 'value' =>'schoolSize',
                 
             ],
             [
                 'attribute' =>'school_category',
                 'filter'=>TbSchool::itemsAlias('school_category'),
                 'value' =>'schoolCategory', 
                 
             ],      
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


    </div><!--box-body pad-->
 </div><!--box box-info-->
