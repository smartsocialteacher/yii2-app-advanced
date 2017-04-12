<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\education\TbStudy */

$this->title = $model->study_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'Tb Studies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>

    <p>
        <?= Html::a(Yii::t('person', 'Update'), ['update', 'id' => $model->study_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('person', 'Delete'), ['delete', 'id' => $model->study_id], [
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
            'study_id',
            'study_year_finish',
            'edu_level_id',
            'study_toplevel',
            'person_id',
            'edu_local_id',
            'major_id',
            'degree_id',
        ],
    ]) ?>


    </div><!--box-body pad-->
 </div><!--box box-info-->
