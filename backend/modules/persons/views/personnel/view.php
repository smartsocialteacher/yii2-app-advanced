<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\teach\TbPersonnel */

$this->title = $model->person_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'Tb Personnels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>

    <p>
        <?= Html::a(Yii::t('person', 'Update'), ['update', 'person_id' => $model->person_id, 'school_id' => $model->school_id, 'position_id' => $model->position_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('person', 'Delete'), ['delete', 'person_id' => $model->person_id, 'school_id' => $model->school_id, 'position_id' => $model->position_id], [
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
            'personnel_start',
            'personnel_end',
            'person_id',
            'school_id',
            'position_id',
        ],
    ]) ?>


    </div><!--box-body pad-->
 </div><!--box box-info-->
