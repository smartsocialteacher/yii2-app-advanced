<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\TbNationality */

$this->title = Yii::t('person', 'Create Tb Nationality');
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'Tb Nationalities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
