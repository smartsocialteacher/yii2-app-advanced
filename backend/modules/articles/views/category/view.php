<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\articles\models\TbArticleCategory */

$this->title = $model->art_cate_id;
$this->params['breadcrumbs'][] = ['label' => 'Tb Article Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
        <!-- <h3 class='box-title'></h3>-->
    </div><!-- /.box-header -->
    <div class='box-body pad'>

        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Update', ['update', 'id' => $model->art_cate_id], ['class' => 'btn btn-primary']) ?>
            <?=
            Html::a('Delete', ['delete', 'id' => $model->art_cate_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </p>

        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'art_cate_id',
                'art_cate_title',
                'art_cate_intro:html',
                'art_cate_created',
                'art_cate_created_by',
                'art_cate_parent_id',
            ],
        ])
        ?>

    </div>
</div>
