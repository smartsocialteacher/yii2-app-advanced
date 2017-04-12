<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Html;
use common\components\Menus;
?>


<?= Html::tag('h3',Yii::t('app','Web Link'),['class'=>'text-left wow fadeInDown article-head']) ?>
<small></small>
<div class="row">
    <div class="col-sm-12">
        <?= Menus::widget(['menu_cate_id'=>3,
        //'show_header'=>true
        'option'=>['class'=>'list-group'],
        'itemOption'=>['class'=>'list-group-item']
        ]); ?>
    </div>
</div>

