<?php
use yii\helpers\Url;
use yii\helpers\BaseStringHelper;
use backend\modules\persons\models\activity\TbActivity;
use backend\modules\articles\models\TbArticleCategory;

$activity = TbActivity::find()->where(['activity_id'=>$activity_id])->all();

use backend\modules\youtube\models\TbYoutube;
$youtube = TbYoutube::find()->all();

?>



<?php if(!empty($youtube)){ ?>

            <div class="section-header">                
                <h3 class="text-left wow fadeInDown article-head animated" style="visibility: visible; animation-name: fadeInDown;">โครงการนักเรียน</h3>
            </div>
            <div class="row">                
                <div class="col-sm-12">                    
                    <?php 
                    foreach($youtube as $k=>$model){
                        $url = Url::to(['/video','id'=>$model->yt_id]); 
                            
                        echo $this->render(
                        '/video/_itemHome',
                        [
                            'model' => $model,
                            'asset'=>$asset,
                            'url' => $url,
                            ]
                        );
                        
               
                    } ?>
                </div>
            </div>

<?php } ?>
