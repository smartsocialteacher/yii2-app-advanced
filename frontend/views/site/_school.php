<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\BaseStringHelper;
use backend\modules\persons\models\teach\TbSchool;


$school = TbSchool::find()->where(['school_type'=>'1'])->limit(10)->all();


?>
<?php if(!empty($school)){ ?>

            <div class="section-header">                
                <h3 class="text-left wow fadeInDown article-head animated" style="visibility: visible; animation-name: fadeInDown;">เครือข่ายโรงเรียน</h3>
            </div>
            <div class="row">                
                <div class="col-sm-12">                    
                    <?php 
                    foreach($school as $k=>$model){
                        $url = Url::to(['/school','id'=>$model->school_id]); 
                        $url_img = (Yii::$app->img->chkImg(TbSchool::PATH_IMG,$model->img_id)&&$model->img_id)?Yii::$app->img->getUploadUrl(TbSchool::PATH_IMG).$model->img_id:Yii::$app->img->getNoImg(); 
                            
                        echo $this->render(
                        '/school/_itemHome',
                        [
                            'model' => $model,
                            'asset'=>$asset,
                            'url' => $url,
                            'url_img' => $url_img,
                            ]
                        );
                        
               
                    } ?>
                    <p>
                        <?=Html::tag('h3',Html::a('<i class="fa fa-chevron-right"></i> โรงเรียนทั้งหมด',Url::to(['/school']),['class'=>'pull-right']))?>
                    </p>
                </div>
            </div>

<?php } ?>
