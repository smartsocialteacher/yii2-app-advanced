<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\TbAddress */

//$this->title = $model->address_id;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'Tb Addresses'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
//echo "<pre>";
//print_r($model);
//echo "</pre>"
?>
<div class='box box-info' >
    
    <div class='box-header' id="address">
     <?= Html::tag('h3', Yii::t('person', 'ข้อมูลที่อยู่'),['class'=>'box-title']);?>
        
        <div class="box-tools pull-right">
        
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>        
    </div><!--box-header -->    
    
<?php
foreach ($address as $model){
?>

<div class='box-body pad'> 
<?= Html::a('<i class="fa fa-pencil"></i>', ['address/update', 'id' => $model->address_id,'person' => $model->person_id], ['class' => 'btn btn-primary btn-sm','title'=>Yii::t('person', 'Update')]) ?>   
 <?php 
    echo "<br/>";
    echo $model->addressOn;
    echo  DetailView::widget([
        'model' => $model,
        'attributes' => [
            'address_id',
            'address_no',
            'address_village',
            'address_mu',
            'address_road',
            'tambol_id',
            'amphur_id',
            'province_id',
            'address_zip_code',
            //'address_on',
            //'person_id',
        ],
    ]);
     echo "<br/>";
    }
  ?>


    </div><!--box-body pad-->
 </div><!--box box-info-->
