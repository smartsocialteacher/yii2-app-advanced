<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\education\TbStudy */

$this->title = Yii::t('person', 'Create Tb Study');
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'Tb Studies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>

    <?= $this->render('_form', [
        'modelCustomer' => $modelCustomer,
        'modelsStudy' =>  $modelsStudy,
        'modelsStudyNew' => $modelsStudyNew
    ]) ?>

    </div><!--box-body pad-->
 </div><!--box box-info-->
