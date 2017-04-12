<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Url;
use backend\modules\persons\models\TbPerson;

$person = TbPerson::find()->with('comments')->all();

?>

<div class="section-header">                
    <h3 class="text-left wow fadeInDown article-head animated" style="visibility: visible; animation-name: fadeInDown;">เครือข่ายครู</h3>
</div>
<div class="row">                
    <div class="col-sm-12">  
        <?php 
                    foreach($person as $k=>$model){
                        $url = Url::to(['/person','id'=>$model->person_id]); 
                            
                        echo $this->render(
                        '/person/_itemHome',
                        [
                            'model' => $model,
                            'asset'=>$asset,
                            'url' => $url,
                            ]
                        );      
                    } ?>

    </div>
</div>