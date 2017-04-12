<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\slide\models\TbSlideCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use common\models\TbUser;
use yii\helpers\ArrayHelper;
//$user = new User();
$user = TbUser::find()->all();
$listUser = ArrayHelper::map($user,'user_id','username');

$this->title = 'Tb Slide Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>
        
    <p>
        <?= Html::a('Create Tb Slide Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'slide_cate_title',
            [
                'attribute' =>'user_id',
                'filter'=>$listUser,
                'value' => function($model){return $model->user->username;},
            ],
            [
                'label' => Yii::t('app','ขนาด'),
                'value' => function($model){
                return $model->slide_cate_width." x ".$model->slide_cate_hiegth." px";
                }
             ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


    </div><!--box-body pad-->
 </div><!--box box-info-->
