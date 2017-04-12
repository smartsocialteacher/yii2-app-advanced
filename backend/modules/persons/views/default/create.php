<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\TbPerson */

$this->title = Yii::t('person', 'เพิ่มบุคคล');
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'บุคคล'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
    <h3><?= Html::encode($this->title) ?></h3>
    </div><!--box-header -->
    
    <div class='box-body pad'>

    <?= $this->render('_tab', [
        'modelPerson' => $modelPerson
    ]) ?>

    </div><!--box-body pad-->
 </div><!--box box-info-->
