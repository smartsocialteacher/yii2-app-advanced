<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\TbPersonType */

$this->title = Yii::t('person', 'Update {modelClass}: ', [
    'modelClass' => 'Tb Person Type',
]) . ' ' . $model->person_type_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'Tb Person Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->person_type_id, 'url' => ['view', 'id' => $model->person_type_id]];
$this->params['breadcrumbs'][] = Yii::t('person', 'Update');
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


    </div><!--box-body pad-->
 </div><!--box box-info-->
