<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\user\models\TbUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tb Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->

    <div class='box-body pad'>

        <p>
            <?= Html::a('Create Tb User', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?=
        GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        //'user_id',
        //'username',
        [
            'attribute' => 'username',
            'content' => function($model){
             return Html::a($model->username,['/user/profile/view','id'=>$model->user_id]);
            },
        ],
        'email:email',
        //'password',
        //'auth_key',
        // 'displayname',
        // 'user_timecreate',
        // 'timestamp',
        // 'user_status',

        ['class' => 'yii\grid\ActionColumn'],
        ],
        ]);
        ?>


    </div><!--box-body pad-->
</div><!--box box-info-->
