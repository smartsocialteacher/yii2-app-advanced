<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\persons\models\TbReligionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('person', 'Tb Religions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>
        
    <p>
        <?= Html::a(Yii::t('person', 'Create Tb Religion'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'religion_id',
            'religion_title',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


    </div><!--box-body pad-->
 </div><!--box box-info-->
