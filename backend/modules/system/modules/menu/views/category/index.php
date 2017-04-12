<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \backend\modules\system\modules\menu\models\SysMenuCategory;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\system\modules\menu\models\SysMenuCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sys Menu Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>
        
    <p>
        <?= Html::a('Create Sys Menu Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'menu_cate_id',
            'menu_cate_title',
            [
                'attribute' => 'menu_cate_status',
                'filter' =>  SysMenuCategory::itemsAlias('status'),
                'value' =>  function($model){
                    return $model->status;
                }
                
               
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


    </div><!--box-body pad-->
 </div><!--box box-info-->
