<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\system\modules\menu\models\SysMenu */

$this->title = $model->menu_id;
$this->params['breadcrumbs'][] = ['label' => 'Sys Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->menu_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->menu_id], [
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
            'menu_id',
            'menu_cate_id',
            'menu_parent_id',
            'menu_title',
            'menu_link',
            'menu_parameter',
            'menu_icon',
            'mod_id',
            'menu_published',
            'menu_access',
            'menu_target',
            'menu_ptc',
            'menu_params',
            'menu_home',
            'menu_sort',
            'language',
            'menu_assoc',
        ],
    ]) ?>


    </div><!--box-body pad-->
 </div><!--box box-info-->
