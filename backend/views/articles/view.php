<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\articles\models\TbArticle */
use app\modules\articles\models\TbArticleCategory;

$artCate = new TbArticleCategory();


$this->title = $model->art_title;
$this->params['breadcrumbs'][] = [
    'label' => $model->artCate->art_cate_title,
    'url' => ['/art/cate', 'id' => $model->art_cate_id]
];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box box-widget">

    <div class="box-header with-border">
        <h2 class="box-header">
            <?= $model->art_title ?>
        </h2>
    </div>

    <div class="box-body"> 
        <?= $model->art_contents ?>
    </div><!-- /.box-body -->

    <div class="box-footer">
        <span class="description"><?= $model->artCate->art_cate_title ?> - <?= $model->art_created ?></span>
    </div><!-- /.box-footer -->
    
</div>

