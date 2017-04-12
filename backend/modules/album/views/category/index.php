<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\album\models\TbAlbumCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tb Album Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->

    <div class='box-body pad'>

        <p>
            <?= Html::a('Create Tb Album Category', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'album_cate_id',
                //'album_cate_title',
                [
                    'attribute' => 'album_cate_title',
                    'content' => function($model) {
                        return Html::a($model->album_cate_title, Url::to(['/album/category/view', 'id' => $model->album_cate_id]));
                    }
                        ],
                        'album_cate_folder',
                        [
                            'attribute' => 'album_cate_parent_id',
                            'content' => function($model) {
                            return $model->album_cate_parent_id?$model->parent->album_cate_title:null;
                    }
                        ],
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]);
                ?>


    </div><!--box-body pad-->
</div><!--box box-info-->
