<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="section-header">                
                <h3 class="text-left wow fadeInDown article-head animated" style="visibility: visible; animation-name: fadeInDown;">วีดีโอทั้งหมด</h3>
            </div>
            <div class="row">                
                <div class="col-sm-12">  
                    <?php echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_item',
                'itemOptions' => [
                    'class' => 'col-sm-12 col-md-12',
                ],
                'layout' =>  '<div class="col-sm-12 col-md-12">{summary}</div>{items}<div class="col-sm-12 col-md-12">{pager}</div>',
    ]);
?>
                    
                    
                    
                    <?php /*
                    foreach($youtube as $k=>$model){
                        $url = Url::to(['/video','id'=>$model->yt_id]); 
                            
                        echo $this->render(
                        '/video/_item',
                        [
                            'model' => $model,                            
                            'url' => $url,
                            ]
                        );                        
               
                    } */?>
                </div>
            </div>