<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\articles\models\TbArticle */
use backend\modules\articles\models\TbArticleCategory;
$artCate=new TbArticleCategory();


$this->title = $model->art_title;
$this->params['breadcrumbs'][] = ['label' => 'จัดการบทความ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
        <!-- <h3 class='box-title'></h3>-->
    </div><!-- /.box-header -->
    <div class='box-body pad'>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->art_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->art_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'art_id',
//            'art_cate_id',
            [
              'label'  => $artCate->getAttributeLabel('art_cate_title'),
               'value' => $model->artCate->art_cate_title,
            ],
            'art_title',
            'art_access',
            'art_published',
            'art_intro:ntext',
            'art_contents:html',
            'art_images:ntext',
            'art_created:datetime',
            'art_created_by',
            'art_modified:datetime',
            'art_modified_by',
            'language',
            'art_start',
            'art_finish',
            'activity_mode',
        ],
    ]) ?>

</div>
</div>
