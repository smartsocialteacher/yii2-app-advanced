<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\modules\persons\models\teach\TbSchool;
/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\teach\TbSchool */

$this->title = $model->school_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'Tb Schools'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>

    <p>
        <?= Html::a(Yii::t('person', 'Update'), ['update', 'id' => $model->school_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('person', 'Delete'), ['delete', 'id' => $model->school_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('person', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    
    <div class="row">
        <div class="col-lg-2">
            <?=
Html::img(
        ($model->img_id) ? Yii::$app->img->getUploadUrl(TbSchool::PATH_IMG) . $model->img_id : Yii::$app->img->getNoimg()
        , [
    'width' => '100%',
    'class' => 'img_id',
]);
?>
    </div>
        <div class="col-lg-10">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'school_id',
            'school_title',
            'school_no',
            'school_village',
            'school_mu',
            'school_road',
            'tambol_id',
            'amphur_id',
            'province_id',
            'phone',
            'fax',
            'degree_id',
            'school_number_staff',
            'school_size',
            'school_category',
            'school_detail:html',
        ],
    ]) ?>
    </div>
    </div>

    </div><!--box-body pad-->
 </div><!--box box-info-->
