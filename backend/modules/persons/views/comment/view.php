<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\TbPersonComment */

$this->title = $model->person->fullname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'Tb Person Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>

    <p>
        <?= Html::a(Yii::t('person', 'Update'), ['update', 'person_id' => $model->person_id, 'person_comment_datetime' => $model->person_comment_datetime], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('person', 'Delete'), ['delete', 'person_id' => $model->person_id, 'person_comment_datetime' => $model->person_comment_datetime], [
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
            //'person_id',
            [
                'attribute' => 'person_id',
                'value' =>$model->person->fullname
            ],
            [
                    'attribute' => 'person_comment_datetime',
                'formate' => 'html',
                    'value' =>Yii::$app->formatter->asDateTime($model->person_comment_datetime, 'medium'),
                        
            ],
            //'person_comment_datetime',
            'person_comment:ntext',
        ],
    ]) ?>


    </div><!--box-body pad-->
 </div><!--box box-info-->
