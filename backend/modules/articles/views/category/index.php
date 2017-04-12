<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\articles\models\TbArticleCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'จัดการหมวดหมู่';
$this->params['breadcrumbs'][] = ['label' => 'บทความ', 'url' => ['/article']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
        <!-- <h3 class='box-title'></h3>-->
    </div><!-- /.box-header -->
    <div class='box-body pad'>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
            <?= Html::a('สร้างหมวดหมู่', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'art_cate_id',
                'art_cate_title',
                //'art_cate_intro:ntext',
                'art_cate_created',
                'art_cate_created_by',
                // 'art_cate_parent_id',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>

    </div>
</div>
