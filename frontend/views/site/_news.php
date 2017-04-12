<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\BaseStringHelper;
use backend\modules\articles\models\TbArticle;
use backend\modules\articles\models\TbArticleCategory;

$arts = TbArticle::find()->where(['art_cate_id'=>$art_cate_id])->all();
$artCate = TbArticleCategory::findOne($art_cate_id);
?>
<?php if(!empty($arts)){ ?>

            <div class="section-header">
                <h3 class="text-left wow fadeInDown article-head"><?=$artCate->art_cate_title?></h3>
<!--                <p class="text-left wow fadeInDown"> เพื่อให้การบูรณาการเทคโนโลยีสารสนเทศเพื่อการออกแบบและพัฒนานวัตกรรมการจัดการศึกษาของโรงเรียนเอกชนสอนศาสนาอิสลามในพื้นที่สามจังหวัดชายแดนภาคใต้ได้มีการพัฒนาที่ทันข่าวสาร"</p>-->
            </div>
            <div class="row">                
                <div class="col-sm-12">                    
                    <?php 
                    foreach($arts as $k=>$model){
                        $url = Url::to(['/'.$link,'id'=>$model->art_id]);
                        $content = strip_tags($model->art_contents);
                        $content = BaseStringHelper::truncate($content,200);
                        
                            
                        echo $this->render(
                        '/news/_itemHome',
                        [
                            'model' => $model,
                            'asset'=>$asset,
                            'url' => $url,
                            'content'=>$content,
                            ]
                        );
                        
               
                    } ?>
                    
                     <p>
                        <?=Html::tag('h3',Html::a('<i class="fa fa-chevron-right"></i> อ่านทั้งหมด',Url::to(['/'.$link]),['class'=>'pull-right']))?>
                    </p>
                </div>
            </div>

<?php } ?>