<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\persons\models\TbAddressSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('person', 'Tb Addresses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>
        
    <p>
        <?= Html::a(Yii::t('person', 'Create Tb Address'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'address_id',
            'address_no',
            'address_village',
            'address_mu',
            'address_road',
            // 'tambol_id',
            // 'amphur_id',
            // 'province_id',
            // 'address_zip_code',
            // 'address_on',
            // 'person_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


    </div><!--box-body pad-->
 </div><!--box box-info-->
