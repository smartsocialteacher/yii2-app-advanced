<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\education\TbEduClass */

$this->title = Yii::t('person', 'Create Tb Edu Class');
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'Tb Edu Classes'), 'url' => ['index']];
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
