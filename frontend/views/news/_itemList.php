<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\BaseStringHelper;
?>

<li class="list-group-item">     
<?=Html::a('<i class="fa fa-paper-plane"></i> '.BaseStringHelper::truncate($model->art_title,33),$url,['style'=>'font-size:18px;','title'=>$model->art_title])?>
</li>
