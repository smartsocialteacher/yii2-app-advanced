<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\album\models\TbAlbumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tb Albums';
$this->params['breadcrumbs'][] = $this->title;

use yii\helpers\ArrayHelper;
use backend\modules\album\models\TbAlbum;
use backend\modules\album\models\TbAlbumCategory;
use yii\helpers\Url;
use yii\helpers\BaseStringHelper;
$cate=new TbAlbumCategory();

$albumCate=new TbAlbumCategory();
$album_cate = TbAlbumCategory::find()->all();
$listCate = ArrayHelper::map($album_cate,'album_cate_id','album_cate_title');

?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>
        
    <p>
        <?= Html::a('Create Tb Album', ['create'], ['class' => 'btn btn-success']) ?>
   
        <?= Html::a('Create Category', ['/album/category'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'album_id',
             [
                'attribute' => 'album_image_intro',
                'format' => 'html',    
                'value' => function ($model) {
                    $url=Url::to(['view','id'=>$model->album_id]);
                    return Html::a(
                            Html::img(TbAlbum::getUploadUrl().$model->album_path."/thumbnail/".$model->album_image_intro, ['width' => '100%']), 
                    $url);
                },
            ],
            [
                'attribute' => "album_title",
                'format' => 'raw',
                'value' => function($model){
                    $url=Url::to(['update','id'=>$model->album_id]);
                    return Html::a($model->album_title,$url).'<br/><small>'.BaseStringHelper::truncate($model->album_detail,250).'</small>';
                },
            ],
            [
                'attribute' =>'album_cate_id',
                'label'=>$albumCate->getAttributeLabel('art_cate_title'),
                'filter'=>$listCate,
                'value' => function($model){return $model->albumCate->album_cate_title;},
            ],
            //'album_detail:ntext',
            'album_path',
            // 'album_image_intro',
            'album_date_create',
            'album_published',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


    </div><!--box-body pad-->
 </div><!--box box-info-->
