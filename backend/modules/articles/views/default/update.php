<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\articles\models\TbArticle */

$this->title = 'Update Tb Article: ' . ' ' . $model->art_id;
$this->params['breadcrumbs'][] = ['label' => 'Tb Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->art_id, 'url' => ['view', 'id' => $model->art_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class='box box-info'>
    <div class='box-header'>
        <!-- <h3 class='box-title'></h3>-->
    </div><!-- /.box-header -->
    <div class='box-body pad'>
        <?=
        $this->render('_form', [
            'model' => $model,
        ])
        ?>
    </div>
</div>
