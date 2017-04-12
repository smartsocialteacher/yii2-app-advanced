<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\persons\models\teach\TbTeachSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('person', 'Tb Teaches');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>
        
    <p>
        <?= Html::a(Yii::t('person', 'Create Tb Teach'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'teach_id',
            'teach_year',
            'teach_term',
            'subject_id',
            'teach_hoursPweek',
            // 'person_id',
            // 'edu_class_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


    </div><!--box-body pad-->
 </div><!--box box-info-->
