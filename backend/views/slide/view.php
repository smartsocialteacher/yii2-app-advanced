<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//use yii\widgets\ListView;
use yii\bootstrap\Carousel;
use yii\helpers\Html;

$items=[];
$path=Yii::$app->img->getUploadUrl().'slide/';
foreach($slide->models as $model){
    $items[]=[
        'content' => Html::img($path.$model->img_id,['width' => '100%','class'=>'thumbnail']),
        'caption' => $model->slide_title,
        'options' => ['width' => '100%']
    ];
}



echo Carousel::widget([
    'items' => $items,    
]);
?>

