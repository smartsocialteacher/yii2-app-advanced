<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\slide\models\TbSlideSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\helpers\ArrayHelper;
use backend\modules\slide\models\TbSlideCategory;

$this->title = 'Tb Slides';
$this->params['breadcrumbs'][] = $this->title;



$user = \common\models\TbUser::find()->all();
$listUser = ArrayHelper::map($user,'user_id','username');

?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>
        
    <p>
        <?= Html::a('Create Tb Slide', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('จัดการหมวดหมู่', ['/slide/category'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'slide_id',
            [
                'attribute' => 'img_id',
                'format' => 'html', 
                'filter'=>false,
                'value' => function ($model) {
                    $url=Url::to(['view','id'=>$model->slide_id]);
                    if($model->img_id)
                    return Html::a(
                            Html::img(Yii::$app->img->getUploadUrl($model->img->img_path_file."/thumbnail/").$model->img_id, ['width' => '100%','class'=>'thumbnail']), 
                    $url);
                },
            ],    
            'slide_title',
            [
                'attribute' => 'slide_cate_id',
                'format' => 'raw', 
                'filter' => ArrayHelper::map(TbSlideCategory::find()->all(),'slide_cate_id','slide_cate_title'),
                'value' => function ($model) {
                    return $model->slideCate->slide_cate_title;
                },
            ],
                        
            'slide_link',
            // 'slide_date_create',
            // 'slide_published',
            // 'slide_sort',
            // 'slide_start',
            // 'slide_end',
            // 'user_id',
             [
                'attribute' => 'user_id',
                'format' => 'raw',
                'filter' => $listUser,
                'value' => function($model){
                 return $model->user->username;
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


    </div><!--box-body pad-->
 </div><!--box box-info-->
