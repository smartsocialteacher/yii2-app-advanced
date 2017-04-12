<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\articles\models\TbArticleCategory */

$this->title = 'Update Tb Article Category: ' . ' ' . $model->art_cate_id;
$this->params['breadcrumbs'][] = ['label' => 'Tb Article Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->art_cate_id, 'url' => ['view', 'id' => $model->art_cate_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tb-article-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
