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
<div class="box">
    <?= Html::tag('h3',$artCate->art_cate_title,['class'=>'text-left wow fadeInDown article-head']) ?>
    <small></small>
    <div class="row">
        <div class="col-sm-12">
            <ul class="list-group">
            <?php 
                    foreach($arts as $k=>$model){
                        $url = Url::to(['/'.$link,'id'=>$model->art_id]);
                        $content = strip_tags($model->art_contents);
                        $content = BaseStringHelper::truncate($content,200);
                        
                            
                        echo $this->render(
                        '/news/_itemList',
                        [
                            'model' => $model,
                            'asset'=>$asset,
                            'url' => $url,
                            'content'=>$content,
                            ]
                        );
                        
               
                    } ?>
                </ul>
           <?=Html::a('อ่านทั้งหมด',['/'.$link],['style'=>'color:#fff !important;font-size:19px;','class'=>'pull-right'])?>            
        </div>
    </div>
</div>




           

<?php } ?>