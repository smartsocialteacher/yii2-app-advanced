<?php
use yii\helpers\Html;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if($menu){
?>

<div class='box box-info'>
    <div class='box-header'>
     <h3 class='box-title'><?=$head_title?></h3>
    </div><!--box-header -->
    
    <div class='box-body pad'>
        <?php
        foreach($menu as $item){
        ?>
        <?= Html::a($item['label'], $item['url'], ['class' => 'btn btn-success']) ?>              
         <?php   
        }        
        ?>
    </div><!--box-body pad-->
 </div><!--box box-info-->
<?php } ?>