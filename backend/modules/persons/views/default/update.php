<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\TbPerson */

$this->title = Yii::t('person', 'Update : ') . ' ' . $modelPerson->fullName;
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'บุคคล'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelPerson->fullName, 'url' => ['profile', 'id' => $modelPerson->person_id]];
$this->params['breadcrumbs'][] = Yii::t('person', 'Update');
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>

    <?= $this->render('_tab', [
        'modelPerson' => $modelPerson,
        'modelAddress' => $modelAddress,
        'modelsStudy' => $modelsStudy,
        'modelPersonnel' => $modelPersonnel,
        'modelsClassTeachers' => $modelsClassTeachers,
        'modelsTeach' => $modelsTeach,
        'modelsActivityJoin' => $modelsActivityJoin,
    ]) ?>


    </div><!--box-body pad-->
 </div><!--box box-info-->
