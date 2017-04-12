<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\TbUser */

$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Tb Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->user_id], [
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
            'user_id',
            'username',
            'email:email',
            'password',
            'auth_key',
            'displayname',
            'user_timecreate',
            'timestamp',
            'user_status',
        ],
    ]) ?>


    </div><!--box-body pad-->
 </div><!--box box-info-->
