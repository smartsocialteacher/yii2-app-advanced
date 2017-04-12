<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\youtube\models\TbYoutube */

$this->title = $model->yt_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'Tb Youtubes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>

    <p>
        <?= Html::a(Yii::t('person', 'Update'), ['update', 'id' => $model->yt_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('person', 'Delete'), ['delete', 'id' => $model->yt_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('person', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'yt_id',
            'yt_vid',
            'yt_title',
            'yt_description:ntext',
            'yt_watchURL:url',
            'yt_thumbnailURL:url',
            'yt_viewCount',
            'yt_length',
            'yt_author',
            'yt_date_create',
            'yt_published',
        ],
    ]) ?>


    </div><!--box-body pad-->
 </div><!--box box-info-->
