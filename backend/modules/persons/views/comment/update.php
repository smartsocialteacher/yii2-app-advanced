<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\TbPersonComment */

$this->title = Yii::t('person', 'Update {modelClass}: ', [
    'modelClass' => 'Tb Person Comment',
]) . ' ' . $model->person_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'Tb Person Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->person_id, 'url' => ['view', 'person_id' => $model->person_id, 'person_comment_datetime' => $model->person_comment_datetime]];
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
