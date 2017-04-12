<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\articles\models\TbArticleCategory */

$this->title = 'สร้างหมู่หมวด';
$this->params['breadcrumbs'][] = ['label' => 'Tb Article Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
